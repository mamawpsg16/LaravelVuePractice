<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Task extends Model
{
     public static function getTasks(){
    	return DB::table('tasks')
    		->orderBy('created_at','DESC')
    		->get()
    		->toArray();
    }

    public static function addTask($data){
    	DB::table('tasks')
    	->insert([
    				'name' 	 => $data['name'],
    				'created_at' => date('Y-m-d H:i:s')
    			]);
    	$id = DB::getPDO()->lastInsertId();
		return DB::table('tasks')
    		->where('id',$id)
    		->first();
    }

    public static function updateTask($data){
    		DB::table('tasks')
			->where('id',$data['id'])
	    	->update([
	    				'completed' => $data['completed'],
			]);
    	return DB::table('tasks')
    		->where('id',$data['id'])
    		->first();
    }
    public static function deleteTask($id){
    	return	DB::table('tasks')
	    		->where('id',$id)
		    	->delete();
    }
}
