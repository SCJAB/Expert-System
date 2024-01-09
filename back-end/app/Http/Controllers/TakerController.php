<?php

namespace App\Http\Controllers;

use App\Models\Taker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function create(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|numeric|min:1',
            'email' => 'required|email|max:255|unique:takers',
            'password' => 'required|min:8|string|max:255|'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()
            ]);
        } else {
            $taker = Taker::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'email' => $request->email,
                'password' => $request->password
            ]);

            if ($taker) {
                return response()->json([
                    'message' => 'Taker Created Successfully'
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
            'age' => 'required|numeric|min:10|max:90',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|string|max:255|'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()
            ]);
        } else {
            $taker = Taker::find($id);

            if ($taker) {

                $taker->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'age' => $request->age,
                    'email' => $request->email,
                    'password' => $request->password
                ]);

                return response()->json([
                    'message' => 'Taker Updated Successfully'
                ]);
            } else {
                return response()->json([
                    'message' => 'Taker Not Found'
                ]);
            }               
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
