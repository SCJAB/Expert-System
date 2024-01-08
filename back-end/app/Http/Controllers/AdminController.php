<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function create(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|numeric|min:1',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:8|string|max:255|'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()
            ]);
        } else {
            $admin = Admin::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'email' => $request->email,
                'password' => $request->password
            ]);

            if ($admin) {
                return response()->json([
                    'message' => 'Admin Created Successfully'
                ]);
            } else {
                return response()->json([
                    'message' => 'Something Went Wrong'
                ]);
            }               
        }
    }

    public function read($id) 
    {
        $admin = Admin::find($id);

        if ($admin) {
            return response()->json([
                'admin' => $admin
            ]);
        } else {
            return response()->json([
                'message' => 'Admin Not Found'
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

    public function update(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|numeric|min:1',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|string|max:255|'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()
            ]);
        } else {
            $admin = Admin::find($id);

            if ($admin) {

                $admin->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'age' => $request->age,
                    'email' => $request->email,
                    'password' => $request->password
                ]);

                return response()->json([
                    'message' => 'Admin Updated Successfully'
                ]);
            } else {
                return response()->json([
                    'message' => 'Admin Not Found'
                ]);
            }               
        }
    }

    public function delete($id) 
    {
        $admin = Admin::find($id);

        if ($admin) {
            $admin->delete();

            return response()->json([
                'message' => 'Admin Deleted Successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Admin Not Found'
            ]);
        }
    }
}
