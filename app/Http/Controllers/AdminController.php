<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function register(Request $request)
    {   

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->route('/')->with('error','Comprova que la contrasenya i la confirmació siguin la mateixa');
        }; 
        // $fields = $request->validate([
           

        // ]);
       

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'admin' => 'true',
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return ($response);

    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'

        ]);
        $user = User::where('email', $fields['email'])->first();
        if (!Hash::check($fields['password'], $user->password)) {
            return redirect()->route('app')->with('error','Email o contrasenya incorrecte');
        }
        
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        $comandes=Comanda::all();
        return view('panel',['sessio' => $response,'comandes'=>$comandes]);

    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Log out fet'
        ];
    }
}
