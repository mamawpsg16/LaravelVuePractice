<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public static function getCustomers(){
    	return DB::table('customers')
    		->orderBy('created_at','DESC')
    		->get()
    		->toArray();
    }

    public static function addCustomer($data){
    	DB::table('customers')
    	->insert($data);
    	return  DB::getPDO()->lastInsertId();
    }

	public static function addCustomerItems($data){
    	return DB::table('customer_items')
    	->insert($data);
    }

    public static function updateCustomer($data){
    		DB::table('customers')
			->where('id',$data['id'])
	    	->update($data);
    	return DB::table('customers')
    		->where('id',$data['id'])
    		->first();
    }

	public static function updateCustomerItems($data){
		DB::table('customer_items')
		->where('id',$data['id'])
		->update($data);
	return DB::table('customers')
		->where('id',$data['id'])
		->first();
	}

	public static function deleteCustomerItems($id){
    	return	DB::table('customer_items')
	    	->where('customer_id',$id)
		    ->delete();
    }

	public static function getCustomerDetails($id){
		return DB::table('customers')
			->where('id',$id)
			->first();
	}

	public static function getCustomerItemsDetails($customer_id){
		return DB::table('customer_items')
			->where('customer_id',$customer_id)
			->get()
			->toArray();
	}

    public static function deleteCustomer($id){
    	return	DB::table('customers')
	    	->where('id',$id)
		    ->delete();
    }
}
