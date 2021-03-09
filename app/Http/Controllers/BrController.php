<?php

namespace App\Http\Controllers;

use App\Events\BrEvent;
use Illuminate\Http\Request;

class BrController extends Controller
{
    public function broadcast(Request $request){
    	broadcast(new BrEvent($request->text));
    }
}
