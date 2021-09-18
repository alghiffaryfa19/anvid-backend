<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HospitalController extends Controller
{
    public function nearest($lat,$lon)
    {
        $hospitals          =       DB::table("hospitals");
        $hospitals          =       $hospitals->select("*", DB::raw("6371 * acos(cos(radians(" . $lat . "))
                                * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $lon . "))
                                + sin(radians(" .$lat. ")) * sin(radians(latitude))) AS distance"));
        $hospitals          =       $hospitals->having('distance', '<', 10);
        $hospitals          =       $hospitals->orderBy('distance', 'asc');

        $hospitals          =       $hospitals->get();
        
        return $hospitals;
    }
}
