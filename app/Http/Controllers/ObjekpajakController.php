<?php

namespace App\Http\Controllers;

use App\Models\ObjekPajak;
use Illuminate\Http\Request;
use App\Http\Resources\ObjekpajakResource;

class ObjekpajakController extends Controller
{
    public function getAll()
    {
        $objekpajak = ObjekPajak::all();
        return ObjekpajakResource::collection($objekpajak);
    }
}
