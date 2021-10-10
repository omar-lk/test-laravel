<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Traits\ResponseTrait;
use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TodoController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return $this->success("todos",$user->todos()->paginate(15)) ;
        // return Todo::where('user_id',$user->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostTodoRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = Auth::id();
            $createdTodo=Todo::create($validated);
            if($createdTodo)
            {
                return $this->success("todo created succefully",[]);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->failure($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return $todo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoRequest $request,Todo $todo)
    {
        $data = $request->all();
        unset($data['user_id']);
        try {
            if($todo->update($data))
            {
                return $this->success("todo updated succefully",[]);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->failure($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        try {
            if ($todo->delete()) {
                return $this->success("todo deleted succefully",[]);
            }
        } catch (\Exception $e) {
           
            return $this->failure($e->getMessage());
        }
    }
}
