<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public static function checkStatus($status){
        if ($status == 0) {
            return '<span>INACTIVE</span>';
        }else{
            return '<span>ACTIVE</span>';
        }
    }

}
