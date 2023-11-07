<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\LineaComanda;
use App\Models\Sabates;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class ControllerComanda extends Controller
{
    public function getComanda()
    {
        $comandes = Comanda::all();
        return $comandes;
    }

    public function createComanda(Request $request)
    {   
        
        $numItem = 1;
        $payload = json_decode($request->getContent(), true);
        $sabates = $payload[1]["sabates"];
        $email = $payload[0]["email"];
        $comanda = new Comanda();
        $comanda->usuari = $email;
        $comanda->estat = "En preparacio";
        $comanda->save();


        $comanda = DB::table('comandas')
                ->latest()
                ->first();
        if ($comanda != null){
            $idComanda = $comanda->id;

        }else{
            $idComanda = 0;
        }
        foreach ($sabates as $sabata) {
            $lineaComanda = new LineaComanda();
            $lineaComanda->idComanda = $idComanda;
            $lineaComanda->numItem = $numItem;
            $numItem++;

            $sabataQuery = Sabates::find( $sabata["id"]);

             $lineaComanda->preu = $sabataQuery->preu;
             $lineaComanda->marca  = $sabata["marca"];
             $lineaComanda->model =  $sabata["model"];
            $lineaComanda->genere =  $sabata["genere"];
            $lineaComanda->talla =  $sabata["talla"];
             $lineaComanda->imatge =  $sabata["imatge"];
             $lineaComanda->color =  $sabata["color"];
             $lineaComanda->quantitat =  $sabata["quantitat"];

            if ( $sabata["quantitat"]<=0) {
                 $lineaComanda->quantitat =  -$sabata["quantitat"];
             }
         $lineaComanda->save();

        }
        
        $comanda = DB::table('linea_comandas')->where('idComanda','=', $idComanda)->get();
        //Mail::to($email)->send(new \App\Mail\Comanda($comanda));
        
        $data["email"] = $email;
        $data["title"] = "Gràcies per la teva compra!";
        $data["body"] = "Rebut de la compra";
        $data["comanda"] = $comanda;
        
        $pdf = Pdf::loadView('comanda', $data);
  
        Mail::send('bodycomanda', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });
    }
    

    public function canviarEstatComanda(Request $request){
        
        $idComanda = $request->idComanda;

        $nouEstat = $request->nouEstat;
        DB::table('comandas')
        ->where('id', $idComanda)
        ->update(['estat' => $nouEstat]);

    }

    public function veuraComanda(){

    }
}
