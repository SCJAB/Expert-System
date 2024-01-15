<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use App\Http\Resources\AdminCreateResource;
use App\Http\Requests\AuthenticateAdminRequest;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Resources\AdminUpdateResource;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function index() 
    {
        $admins = Admin::all();

        if ($admins->count() > 0) {
            return response()->json(['admins' => $admins]);
        } else {
            return response()->json([
                'admins' => 'No Admins Found'
            ]);
        }
    }


    //Login Admin
    public function login(AuthenticateAdminRequest $payload){
        $email = $payload->email; 
        $password = $payload->password;

        $admin = Admin::where('email', $email)->first();

        if(!$admin || !Hash::check($password, $admin->password)){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect'],
            ]);
        }

        return (object) [
            'user' => new AdminResource($admin),
            'token' => $admin->createToken('auth-token')->plainTextToken
        ];
    }

    public function create(CreateAdminRequest $payload) 
    {
        $first_name = $payload->first_name;
        $last_name = $payload->last_name;
        $age = $payload->age;
        $email = $payload->email;
        $password = $payload->password;

        $admin = Admin::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'age' => $age,
            'email' => $email,
            'password' => $password
        ]);

        return new AdminCreateResource($admin);
    }


    public function read($id) 
    {
        $admin = Admin::find($id);

        if ($admin) {
            return response()->json([
                'message' => $admin
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

    public function update(UpdateAdminRequest $payload, $id) 
    {
        $first_name = $payload->first_name;
        $last_name = $payload->last_name;
        $age = $payload->age;
        $email = $payload->email;
        $password = $payload->password;

        $admin = Admin::find($id);

            if ($admin) {

                $admin->update([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'age' => $age,
                    'email' => $email,
                    'password' => $password
                ]);
            }

            return new AdminUpdateResource($admin);               
    }
    

    public function delete($id) 
    {
        $admin = Admin::find($id);

        if ($admin) {
            $admin->delete();
        }
    }
}
