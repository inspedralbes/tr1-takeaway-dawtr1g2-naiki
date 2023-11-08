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
    public function crearSabata(Request $request){
        $sabata = new Sabates;
        $sabata->marca = $request->marca;
        $sabata->model = $request->model;
        $sabata->genere = $request->genere;
        $sabata->preu = $request->preu;

        $sabata->talles = $request->talles;
        $sabata->color  = $request->color; 
        $sabata->imatge = "img"; 
        $sabata->save();
        session()->put("sabates", Sabates::all());
        session()->save();
        return redirect()->route("sabates");
    }
}
