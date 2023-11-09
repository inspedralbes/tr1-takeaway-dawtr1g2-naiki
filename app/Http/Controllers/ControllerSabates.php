<?php

namespace App\Http\Controllers;

use App\Models\Sabates;
use Illuminate\Http\Request;

class ControllerSabates extends Controller
{
    public function getSabates()
    {
        $sabates = Sabates::all();
        return $sabates;
    }
    public function crearSabata(Request $request)
    {
        $sabata = new Sabates;
        $sabata->marca = $request->marca;
        $sabata->model = $request->model;
        $sabata->genere = $request->genere;
        $sabata->preu = $request->preu;

        $sabata->talles = $request->talles;
        $sabata->color = $request->color;
        $new = $request->model . '_' . $request->color . '.jpg';
        $src = $request->file('img')->storeAs('imagen', $new, ['disk' => 'sabates']);
        $sabata->imatge = $src;
        $sabata->save();
        session()->put("sabates", Sabates::all());
        session()->save();
        return redirect()->route("sabates");
    }
    public function updateSabata(Request $request)
    {
        $sabata = Sabates::find($request->idSabata);
        $sabata->marca = $request->marca;
        $sabata->model = $request->model;
        $sabata->genere = $request->genere;
        $sabata->preu = $request->preu;

        $sabata->talles = $request->talles;
        $sabata->color = $request->color;
        if ($request->img != null) {
            $new = $request->model . '_' . $request->color . '.jpg';
            $src = $request->file('img')->storeAs('imagen', $new, ['disk' => 'sabates']);
            $sabata->imatge = $src;
        }
        $sabata->save();
        session()->put("sabates", Sabates::all());
        session()->save();
        return redirect()->route("sabates");
    }
}
