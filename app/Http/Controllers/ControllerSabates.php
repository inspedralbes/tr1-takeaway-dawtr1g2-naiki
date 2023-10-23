<?php

namespace App\Http\Controllers;

use App\Models\Sabates;
use Illuminate\Http\Request;
class ControllerSabates extends Controller
{
    public function getSabates(){
        $sabates = Sabates::all();
        return $sabates;
    }
    public function createSabates(Request $request){
        $sabata = new Sabates;
        $sabata->marca = $request->marca;
        $sabata->model = $request->model;
        $sabata->genere = $request->genere;
        $sabata->talles = $request->talles;
        $sabata->color  = $request->color;  
        $sabata->imatge = $request->imatge;
        $sabata->save();
        return $sabata;
    }
}
