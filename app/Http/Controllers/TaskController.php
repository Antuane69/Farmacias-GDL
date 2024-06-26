<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(){
        $priorities = ['Low','Intermediate','High'];
        $users = User::all();
        $task = new Task();
        $tags = ['Front-End','Back-End','Server','Bug','Other'];

        return view('tasks.createTasks',[
            'users' => $users,
            'priorities' => $priorities,
            'task' => $task,
            'tags' => $tags
        ]);
    }

    public function save(Request $request, $id = null){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'user' => 'required',
            'priority' => 'required',
            'tag' => 'required',
        ]);

        if($id){
            $task = Task::find($id);

            $task->title = $request->title;
            $task->description = $request->description;
            $task->dueDate = $request->due_date;
            $task->user_id = $request->user;
            $task->priority = $request->priority;
            $task->tags = $request->tag;

            $task->save();
        }else{
            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'dueDate' => $request->due_date,
                'user_id' => $request->user,
                'priority' => $request->priority,
                'tags' => $request->tag
            ]);
        }

        return redirect()->route('show.task');
    }

    public function show(){
        if(auth()->user()->role == 'Administrator'){
            $tasks = Task::all();
        }else{
            $tasks = Task::where('user_id',auth()->user()->id)->get();
        }

        return view('tasks.showTasks',[
            'tasks' => $tasks
        ]);
    }

    public function delete($id){
        Task::find($id)->delete();

        return redirect()->route('show.task');
    }

    public function edit($id){
        $priorities = ['Low','Intermediate','High'];
        $users = User::all();
        $task = Task::find($id);
        $tags = ['Front-End','Back-End','Server','Bug','Other'];

        return view('tasks.createTasks',[
            'users' => $users,
            'priorities' => $priorities,
            'task' => $task,
            'tags' => $tags
        ]);
    }

    public function update($id){
        $task = Task::find($id);
        $task->isCompleted = true;
        $task->save();

        return redirect()->route('show.task');
    }
}
