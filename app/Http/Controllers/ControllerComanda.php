<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\LineaComanda;
use App\Models\Sabates;
use Barryvdh\DomPDF\Facade\Pdf;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\PersonalAccessToken;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Validator;

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
        if ($comanda != null) {
            $idComanda = $comanda->id;

        } else {
            $idComanda = 0;
        }
        foreach ($sabates as $sabata) {
            $lineaComanda = new LineaComanda();
            $lineaComanda->idComanda = $idComanda;
            $lineaComanda->numItem = $numItem;
            $numItem++;

            $sabataQuery = Sabates::find($sabata["id"]);

            $lineaComanda->preu = $sabataQuery->preu;
            $lineaComanda->marca = $sabata["marca"];
            $lineaComanda->model = $sabata["model"];
            $lineaComanda->genere = $sabata["genere"];
            $lineaComanda->talla = $sabata["talla"];
            $lineaComanda->imatge = $sabata["imatge"];
            $lineaComanda->color = $sabata["color"];
            $lineaComanda->quantitat = $sabata["quantitat"];

            if ($sabata["quantitat"] <= 0) {
                $lineaComanda->quantitat = -$sabata["quantitat"];
            }
            $lineaComanda->save();

        }

        $lineasComanda = DB::table('linea_comandas')->where('idComanda', '=', $idComanda)->get();
        $comanda = Comanda::find($idComanda);
        //Mail::to($email)->send(new \App\Mail\Comanda($comanda));
        $qrData = [
            'Ticket ID' => $comanda->id,
            'Email' => $comanda->usuari,
        ];
        $jsonQrCode = json_encode($qrData);
        $qrCode = QrCode::size(300)->generate($jsonQrCode);

        $qrCodeFileName = 'ticket_' . $comanda->id . '_qr.svg';

        try {
            Storage::disk('pdf')->put('qr/' . $qrCodeFileName, $qrCode);

            $imagePath = 'qr/' . $qrCodeFileName;
            $comanda->qr = $imagePath;
            $comanda->save();
        } catch (\Exception $e) {
            \Log::error('Error al almacenar el código QR: ' . $e->getMessage());
            return response()->json(['error' => 'Error al almacenar el código QR'], 500);
        }

        $data["email"] = $email;
        $data["title"] = "Gràcies per la teva compra!";
        $data["body"] = "Rebut de la compra";
        $data["lineasComanda"] = $lineasComanda;
        $data["comanda"] = $comanda;

        $pdf = Pdf::loadView('comanda', $data);

        Mail::send('bodycomanda', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "text.pdf");
        });
    }


    public function canviarEstatComanda(Request $request)
    {
        $checkToken = session()->get('token');
        //$result = PersonalAccessToken::where('token', Hash::make($token))->first();
        //$idComanda = $request->idComanda;
        if ( !($checkToken == null ||  $checkToken == "" ||  $checkToken == "null") ) {

            //Return if the user is logged in or not from the token
            [$id, $token] = explode('|', $checkToken, 2);
            $accessToken = PersonalAccessToken::find($id);
            
            if ($accessToken != null) {
                if (! hash_equals($accessToken->token, hash('sha256', $token))) {
                    return redirect()->route('app')->with('error','Sessió expirada');
                }
            }else{
                return redirect()->route('app')->with('error','Sessió expirada');

            }

        }else{
            return redirect()->route('app')->with('error','Sessió expirada');

        }
        $nouEstat = $request->nouEstat;
        $idComanda = $request->idComanda;
        DB::table('comandas')
        ->where('id', $idComanda)
        ->update(['estat' => $nouEstat]);
        session()->put('comandes', Comanda::all());
        session()->save();
        return redirect()->route('panel')->with('success','Estat actualitzat correctament');

    }

    public function veuraComanda()
    {

    }
}
