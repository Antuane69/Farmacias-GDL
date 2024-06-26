<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\SubTask;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class SubTaskController extends Controller
{
    public function create(){
        if(auth()->user()->role == 'Administrator'){
            $tasks = Task::all();
        }else{
            $tasks = Task::where('user_id',auth()->user()->id)->get();
        }
        $subtask = new SubTask();

        return view('tasks.createSubTasks',[
            'tasks' => $tasks,
            'subtask' => $subtask
        ]);
    }

    public function save(Request $request, $id = null){
        $this->validate($request, [
            'title' => 'required',
            'task' => 'required',
        ]);

        if($id){
            $task = SubTask::find($id);

            $task->title = $request->title;
            $task->task_id = $request->task;

            $task->save();
        }else{
            SubTask::create([
                'title' => $request->title,
                'task_id' => $request->task,
            ]);
        }

        return redirect()->route('show.subtask');
    }

    public function show(){
        if(auth()->user()->role == 'Administrator'){
            $tasks = Task::with('SubTasks')->get();
        }else{
            $tasks = Task::where('user_id',auth()->user()->id)->with('SubTasks')->get();
        }

        return view('tasks.showSubTasks',[
            'tasks' => $tasks
        ]);
    }

    public function delete($id){
        SubTask::find($id)->delete();

        return redirect()->route('show.subtask');
    }

    public function edit($id){
        if(auth()->user()->role == 'Administrator'){
            $tasks = Task::all();
        }else{
            $tasks = Task::where('user_id',auth()->user()->id)->get();
        }
        $subtask = SubTask::find($id);
 
        return view('tasks.createSubTasks',[
            'tasks' => $tasks,
            'subtask' => $subtask
        ]);
    }

    public function update($id){
        $subtask = SubTask::find($id);
        $subtask->isCompleted = true;
        $subtask->save();

        return redirect()->route('show.subtask');
    }
}
