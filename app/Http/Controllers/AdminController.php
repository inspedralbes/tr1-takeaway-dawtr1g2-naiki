<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function register(Request $request)
    {   
        
        //return ("TEST");
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'cognoms' => 'required|string',
            'telefon' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => 1,
                'missatge' => 'Comprova que la contrasenya i la confirmació siguin la mateixa'
            ];
            return (json_encode($response));
        };
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|unique:users,email',
        ]);

        if ($validator->fails()) {
            $response = [
                'error' => 2,
                'missatge' => 'Email ja esta en ús'
            ];
            return (json_encode($response));

        };
       
        $user = User::create([
            'nom' => $request->nom,
            'cognoms' => $request->cognoms,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'telefon' =>$request->telefon,
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'missatge' => 'Compte creat correctament'
        ];
        return (json_encode($response));

    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'

        ]);
        $user = User::where('email', $fields['email'])->first();
        if (!Hash::check($fields['password'], $user->password)) {
            $response = [
                'user' => $user,
                'missatge' => 'Email o contrasenya incorrecte'
            ];
            return (json_encode($response));
        }
        
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return (json_encode($response));

    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Log out fet'
        ];
    }

    public function mostrarPanel(){
        $comandes=Comanda::all();
        return view('panel',['comandes'=>$comandes]);

    }
    public function canviarEstatComanda(Request $request){
        
        $idComanda = $request->idComanda;

        $nouEstat = $request->nouEstat;
        DB::table('comandas')
        ->where('id', $idComanda)
        ->update(['estat' => $nouEstat]);
        return redirect()->route('panel')->with('success','Estat actualitzat correctament');
    }
}
