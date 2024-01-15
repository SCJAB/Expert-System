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
        }
    }

    // public function edit($id) 
    // {
    //     $taker = Taker::find($id);

    //     if ($taker) {
    //         return response()->json([
    //             'taker' => $taker
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message' => 'Taker Not Found'
    //         ]);
    //     }
    // }

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
        }
    }
}
