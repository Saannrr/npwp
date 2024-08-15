<?php

namespace App\Http\Controllers;

use App\Http\Resources\IdentitasResource;
use Illuminate\Http\Request;
use App\Models\IdentitasOrang;

class IdentitasController extends Controller
{
    public function getAllIdentitas()
    {
        $identitas = IdentitasOrang::all();
        return IdentitasResource::collection($identitas);
    }
}
