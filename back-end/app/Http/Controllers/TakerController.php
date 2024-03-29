<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateTakerRequest;
use App\Http\Requests\CreateTakerRequest;
use App\Http\Requests\UpdateTakerRequest;
use App\Http\Resources\AuthenticatedTakerResource;
use App\Http\Resources\TakerResource;
use App\Http\Resources\TakerCreateResource;
use App\Http\Resources\TakerUpdateResource;
use App\Models\Taker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class TakerController extends Controller
{
    public function index() 
    {
        $takers = Taker::all();

        if ($takers->count() > 0) {
            return response()->json(['takers' => $takers]);
        } else {
            return response()->json([
                'takers' => 'No Takers Found'
            ]);
        }
         
    } 

    public function login(AuthenticateTakerRequest $payload){
        $email = $payload->email; 
        $password = $payload->password;

        $taker = Taker::where('email', $email)->first();

        if(!$taker || !Hash::check($password, $taker->password)){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect'],
            ]);
        }

        $response = (object) [
            'user' => new TakerResource($taker),
            'token' => $taker->createToken('auth-token')->plainTextToken
        ];

        return new AuthenticatedTakerResource($response);
    }

    public function logout(Request $payload){
        $taker = $payload->user();
        $taker->tokens()->delete();
        return "logout success";
    }

    public function sendVerifyEmail($email){
        if(auth()->user()){
            $taker = Taker::where('email', $email)->first();
    
            if($taker){
                $random = Str::random(40);
                $domain = URL::to('/');
                $url = $domain.'/verify-mail/takers/'.$random;
    
                $data['url'] = $url;
                $data['email'] = $email;
                $data['title'] = "Email verification";
                $data['body'] = "Please click here to verify";
    
                // Use the correct view name for the mail
                Mail::send('verifyMail',['data' => $data], function($message) use ($data){
                    $message->to($data['email'])->subject($data['title']);
                });
    
                // Retrieve the model instance
                $takerModel = Taker::find($taker->id);
                $takerModel->remember_token = $random;
                $takerModel->save();
    
                return response()->json(['success'=>true, 'msg'=>'Mail sent success', '__token' => $random]);
            }
            else{
                return response()->json(['success'=>false, 'msg'=>'User is not found']);
            }
        }
        else{
            return response()->json(['success'=>false, 'msg'=>'User is not authenticated']);
        }
    }

    public function verificationMail($token){
        $taker = Taker::where('remember_token',$token)->get();
        if(count($taker) > 0){
            $datetime = Carbon::now()->format('Y-m-d H:i:s');
            $taker = Taker::find($taker[0]['id']);
            $taker->remember_token = '';
            $taker->is_verified = 1;
            $taker->email_verified_at = $datetime;
            $taker->save();
            return redirect('http://localhost:3000/dashboard')->with([
                'success' => true,
                'msg' => 'User is verified',
            ]);
        }
        else{
            return response()->json([
                'success'=>false, 'msg'=>'404'
            ]);
        }

    }
    

    public function getTaker(Request $payload)
    {
        $taker = $payload->user();
        return new TakerResource($taker);
    }

    public function create(CreateTakerRequest $payload) 
    {
        $first_name = $payload->first_name;
        $last_name = $payload->last_name;
        $age = $payload->age;
        $email = $payload->email;
        $password = $payload->password;

        $taker = Taker::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'age' => $age,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        return new TakerCreateResource($taker);            
    }

    public function read($id) 
    {
        $taker = Taker::find($id);

        if ($taker) {
            return response()->json([
                'taker' => $taker
            ]);
        } else {
            return response()->json([
                'message' => 'Taker Not Found'
            ]);
        }
    }

    public function update(UpdateTakerRequest $payload, $id) 
    {
        $taker = Taker::find($id);

        if ($taker) {

            $taker->update([
                'first_name' => $payload->first_name,
                'last_name' => $payload->last_name,
                'age' => $payload->age,
                'email' => $payload->email,
                'password' => $payload->password
            ]);

            return new TakerUpdateResource($taker);
        }               
    }

    public function delete($id) 
    {
        $taker = Taker::find($id);

        if ($taker) {
            $taker->delete();

            return response()->json([
                'message' => 'Taker Deleted Successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Taker Not Found'
            ]);
        }
    }
}
