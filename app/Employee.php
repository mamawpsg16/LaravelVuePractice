<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Employee extends Model
{
     public static function getEmployees(){
    	return DB::table('employees')
    		->orderBy('created_at','DESC')
    		->get()
    		->toArray();
    }

    public static function addEmployee($data){
    	DB::table('employees')
    	->insert([
    				'name' 	 		=> $data['name'],
					'contact' 		=>$data['contact'],
					'address' 		=> $data['address'],
					'department_id' => $data['department_id'],
    				'created_at' 	=> date('Y-m-d H:i:s')
    			]);
    	$id = DB::getPDO()->lastInsertId();
		return DB::table('employees')
    		->where('id',$id)
    		->first();
    }

    public static function updateEmployee($data){
    		DB::table('employees')
			->where('id',$data['id'])
	    	->update([
						'name' 	 		=> $data['name'],
						'contact' 		=> $data['contact'],
						'address' 		=> $data['address'],
						'department_id' => $data['department_id'],
						'status' 		=> $data['status'],
						'updated_at' 	=> date('Y-m-d H:i:s')
			]);
    	return DB::table('employees')
    		->where('id',$data['id'])
    		->first();
    }

	public static function getEmployeeDetails($id){
		return DB::table('employees')
			->where('id',$id)
			->first();
	}

    public static function deleteEmployee($id){
    	return	DB::table('employees')
	    	->where('id',$id)
		    ->delete();
    }

	public static function getEmployeesLimit($query)
    {
        return DB::table('employees')
                ->select('id','name')
                ->where('name','LIKE',"%{$query}%")
                ->where('status',1)
                ->get()->toArray();
    }

    public static function getEmployeesLimitDefault()
    {
        return DB::table('employees')
                ->select('id','name')
                ->where('status',1)
                ->limit(50)
                ->get()->toArray();
    }
}
