<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public static function getInventories(){
    	return DB::table('inventories')
    		->orderBy('created_at','DESC')
    		->get()
    		->toArray();
    }

    public static function addInventory($data){
    	DB::table('inventories')
    	->insert([
                    'code' 		    => $data['code'],
    				'name' 	 		=> $data['name'],
					'description' 	=> $data['description'],
					'unit_price'    => $data['unit_price'],
                    'date'          => date('Y-m-d', strtotime($data['date'])),
    				'created_at' 	=> date('Y-m-d H:i:s')
    			]);
    	$id = DB::getPDO()->lastInsertId();
		return DB::table('inventories')
    		->where('id',$id)
    		->first();
    }

    public static function updateInventory($data){
    		DB::table('inventories')
			->where('id',$data['id'])
	    	->update([
						'code' 		    => $data['code'],
						'name' 	 		=> $data['name'],
						'description' 	=> $data['description'],
						'unit_price'    => $data['unit_price'],
						'date'          => date('Y-m-d', strtotime($data['date'])),
						'status'  		=> $data['status'],
						'updated_at' 	=> date('Y-m-d H:i:s')
			]);
    	return DB::table('inventories')
    		->where('id',$data['id'])
    		->first();
    }

	public static function getInventoryDetails($id){
		return DB::table('inventories')
			->where('id',$id)
			->first();
	}

    public static function deleteInventory($id){
    	return	DB::table('inventories')
	    	->where('id',$id)
		    ->delete();
    }

	public static function getInventoriesLimit($query)
    {
        return DB::table('inventories')
				->select(DB::raw('
						id, 
						concat(code, " : ", name) as name,
						description,
						unit_price
					'))
				->where(DB::raw('CONCAT(code, " : " ,name)'), 'LIKE', "%{$query}%")
                ->where('status',1)
                ->get()->toArray();
    }

    public static function getInventoriesLimitDefault()
    {
        return DB::table('inventories')
				->select(DB::raw('
                        id, 
                        concat(code, " : ", name) as name,
						description,
						unit_price
                    '))
                ->where('status',1)
                ->limit(50)
                ->get()->toArray();
    }
    public static function getSingleInvetoryForMultiSelect($id)
    {
        return DB::table('inventories')
				->select(DB::raw('
                        id, 
                        concat(code, " : ", name) as name
                    '))
                ->where('id',$id)
                ->first();
    }
}
