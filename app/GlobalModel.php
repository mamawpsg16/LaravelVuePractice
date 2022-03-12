<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class GlobalModel extends Model
{
    public static function getSingleDataTable($table='',$id=''){
        return DB::table($table)
        ->where('id',$id)
        ->first();
    }
}
