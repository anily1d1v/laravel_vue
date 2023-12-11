<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $todo = Todo::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:todos',
          ]);

          if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ], 422);
        } else {
          $student = Todo::create([
            'name' => $request->input('name')
          ]);

          if($student){
            return response()->json([
                'status' => 200,
                'message' => 'Todo Added Successfully',
           ],200);
          }else{
            return response()->json([
                'status' => 500,
                'message' => 'Something Went Wrong',
           ],500);
          }

          
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $id)
    {
        $todo = Todo::find($id);

        if ($todo) {
            return response()->json([
                'status' => 200,
                'data' => $todo,
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Todo not found',
            ], 404);
        } 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
             'name' => 'required',
          ]);

          if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ], 422);
        } else {
            $todo_update = Todo::find($id);
            if($todo_update){
                $todo_update->name = $request->input('name');
                $todo_update->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Todo Updated Successfully',
               ],200);
            }else{
            return response()->json([
                'status' => 404,
                'message' => 'Something Went Wrong',
            ],404);
          }

          
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);

        if ($todo) {
            $todo->delete();
        
            return response()->json([
                'status' => 200,
                'message' => 'Student Deleted Successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Student not found',
            ], 404);
        }
    }
}
