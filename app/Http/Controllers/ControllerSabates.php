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
}
