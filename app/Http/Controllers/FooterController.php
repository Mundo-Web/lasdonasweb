<?php

namespace App\Http\Controllers;

use App\Models\General;
use Illuminate\Http\Request;

class FooterController extends Controller
{
   public function footerData(){

        $datosgenerales = General::all();      
        return view('components.public.footer', compact('datosgenerales'));
        
   }
}
