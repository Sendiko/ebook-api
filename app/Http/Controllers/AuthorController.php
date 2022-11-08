<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Author::all();
        return response()->json([
            'status' => '200',
            'message' => 'data succcesfully retrieved',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = Author::create([
            "name" => $request->name,
            "date_of_birth" => $request->date_of_birth,
            "place_of_birth" => $request->place_of_birth,
            "gender" => $request->gender,
            "email" => $request->email,
            "phone" => $request->phone
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'data successfully created',
            'data' => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);
        if($author){
            return response()->json([
                'status' => 200,
                'data' => $author
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => `$id not found` 
            ], 404);
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        if($author){
            $author->name = $request->name ? $request->name : $author->name;
            $author->date_of_birth = $request->date_of_birth ? $request->date_of_birth : $author->date_of_birth;
            $author->place_of_birth = $request->place_of_birth ? $request->place_of_birth : $author->place_of_birth;
            $author->gender = $request->gender ? $request->gender : $author->gender;
            $author->email = $request->email ? $request->email : $author->email;
            $author->phone = $request->phone ? $request->phone : $author->phone;
            $author->save();
            return response()->json([
                'status' => 200,
                'data' => $author,
                'message' => 'data successfully updated'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'data' => $author,
                'message' => `$id not found`
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = author::where('id', $id)->first();
        if($author){
            $author->delete();
            return response()->json([
                'status' => 200,
                'message' => 'data successfully deleted'
            ], 200);
        }else {
            return response()->json([
                'status' => 404,
                'message' => `$id not found`
            ], 404);
        }
    }
}
