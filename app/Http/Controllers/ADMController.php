<?php

namespace App\Http\Controllers;

use App\Http\Requests\ADMRequest;
use App\Models\ADM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ADMController extends Controller
{
   
    public function recuperarSenha(Request $request)
    {

        $ADM = ADM::where('email', '=', $request->email)->first();

        if (!isset($ADM)) {
            return response()->json([
                'status' => false,
                'message' => "Email invalido"

            ]);
        }

        if (isset($ADM->cpf)) {
           
            $ADM->password = Hash::make( $ADM->cpf );
            
        }
        $ADM->update();

        return response()->json([
            'status' => true,
            'password' => $ADM->password
        ]);
    }
}
