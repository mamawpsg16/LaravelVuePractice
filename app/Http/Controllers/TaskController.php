<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class TaskController extends Controller
{
    public function index(){
    	$task_details  = Task::getTasks();

    	return response()->json($task_details);
    }

    public function addTask(Request $request){
    	$data 		  = $request->all();
    	$new_task     = Task::addTask($data);
    	return response()->json($new_task);
    }

    public function updateTask(Request $request){
    	$data 		   = $request->all();
    	$updated_task  = Task::updateTask($data);
    	return response()->json($updated_task);
    }

    public function deleteTask(Request $request){
    	$id 		    = $request->all();
    	$result  		= Task::deleteTask($id);
    	return response()->json(['message'=>'Successfully deleted']);
    }


    // public function getTaskDetails(Request $request){
    // 	$data 		   = $request->all();
    // 	$task_details  = Task::addTaskDetails($data);
    // 	return response()->json($task_details);
    // }
}
