<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerComanda extends Controller
{
    public function getComanda()
    {
        $comandes = Comanda::all();
        return $comandes;
    }

    public function createComanda(Request $request)
    {   
        $sabata = DB::table('comandaS')
                ->latest()
                ->first();
        if ($sabata != null){
            $idComanda = $sabata->idComanda + 1;

        }else{
            $idComanda = 0;
        }
        $numItem = 1;
        $payload = json_decode($request->getContent(), true);
        $sabates = $payload[1]["sabates"];
        $email = $payload[0]["email"];
        foreach ($sabates as $sabata) {
            $comanda = new Comanda();
            $comanda->idComanda = $idComanda;
            $comanda->numItem = $numItem;
            $numItem++;
            $comanda->usuari = $email;
            $comanda->marca  = $sabata["marca"];
            $comanda->model =  $sabata["model"];
            $comanda->genere =  $sabata["genere"];
            $comanda->talla =  $sabata["talla"];
            $comanda->imatge =  $sabata["imatge"];
            $comanda->color =  $sabata["color"];
            $comanda->quantitat =  $sabata["quantitat"];
            $comanda->estat = "En preparacio";
            $comanda->save();

        }
    }
}
