<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Department extends Model
{
     public static function getDepartments(){
    	return DB::table('departments')
    		->orderBy('created_at','DESC')
    		->get()
    		->toArray();
    }

    public static function addDepartment($data){
    	DB::table('departments')
    	->insert([
    				'name' 	 => $data['name'],
    				'created_at' => date('Y-m-d H:i:s')
    			]);
    	$id = DB::getPDO()->lastInsertId();
		return DB::table('departments')
    		->where('id',$id)
    		->first();
    }

    public static function updateDepartment($data){
    		DB::table('departments')
			->where('id',$data['id'])
	    	->update([
	    				'status' => $data['status'],
			]);
    	return DB::table('departments')
    		->where('id',$data['id'])
    		->first();
    }

	public static function getDepartmentsLimit($query)
    {
        return DB::table('departments')
                ->select('id','name')
                ->where('name','LIKE',"%{$query}%")
                ->where('status',1)
                ->get()->toArray();
    }

    public static function getDepartmentsLimitDefault()
    {
        return DB::table('departments')
                ->select('id','name')
                ->where('status',1)
                ->limit(50)
                ->get()->toArray();
    }

	public static function getSpecificDepartment($id){
		return DB::table('departments')
    		->where('id',$id)
    		->first();
	}
}
