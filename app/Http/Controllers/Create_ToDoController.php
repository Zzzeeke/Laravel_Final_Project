<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;


class Create_ToDoController extends Controller
{
    public function create(){
        return view('create_todo');
    }

    public function store(Request $request){

        $request->validate([
            'title'=>'required|string',
            'description'=>'nullable',
            'date'=>'required|date',
            'time'=>'required|date_format:H:i',
        ]);

        Todo::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'date'=>$request->input('date'),
            'time'=>$request->input('time'),
        ]);

        return redirect()->route('dashboard')->with('success', 'ToDo list added successfully!');

    }

    public function dashboard()
    {
        $todos = Todo::all(); 
        $completedTodos = $todos->where('completed', true);
        $incompleteTodos = $todos->where('completed', false);
    
        return view('dashboard', [
            'completedTodos' => $completedTodos,
            'incompleteTodos' => $incompleteTodos,
        ]);
    }

    

    public function markCompleted($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->completed = !$todo->completed; 
            $todo->save();
        }
        return redirect()->route('dashboard');
    }
}