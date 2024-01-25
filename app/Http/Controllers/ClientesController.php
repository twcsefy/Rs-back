<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientesController extends Controller
{
    public function store(clienteFormRequest $request){
        $cliente = Clientes::create([
            'nome' => $request->nome,
            'celular' => $request->celular,
            'email'=>$request->email,
            'cpf'=>$request->cpf,
            'dataNascimento'=>$request->dataNascimento,
            'cidade'=>$request->cidade,
            'estado'=>$request->estado,
            'pais'=>$request->pais,
            'rua'=>$request->rua,
            'numero'=>$request->numero,
            'bairro'=>$request->bairro,
            'cep'=>$request->cep,
            'complemento'=>$request->complemento,
            'password'=>Hash::make($request->password),
           
        ]);
       
        return response()->json([
            "succes" => true,
            "message" =>"Cliente Cadastrado com sucesso",
            "data" => $cliente


        ],200);
    }

    

    public function retornarTodosClientes()
    {
        $cliente = Clientes::all();

        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }
        return response()->json([
            'status' => false,
            'data' => 'Não há nenhum cliente registrado'
        ]);
    }
    
    public function excluirCliente($id)
    {
        $cliente = Clientes::find($id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não encontrado"
            ]);
        }

        $cliente->delete();
        return response()->json([
            'status' => true,
            'message' => "Cliente excluido com sucesso"
        ]);
    }

    public function editarCliente(ClienteFormRequest $request)
    {
        $cliente = Clientes::find($request->id);
        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não encontrado"
            ]);
        }

        if (isset($request->nome)) {
            $cliente->nome = $request->nome;
        }

        if (isset($request->celular)) {
            $cliente->celular = $request->celular;
        }
        if (isset($request->email)) {
            $cliente->email = $request->email;
        }
        if (isset($request->cpf)) {
            $cliente->cpf = $request->cpf;
        }
        if (isset($request->dataNascimento)) {
            $cliente->dataNascimento = $request->dataNascimento;
        }
        if (isset($request->cidade)) {
            $cliente->cidade = $request->cidade;
        }
        if (isset($request->estado)) {
            $cliente->estado = $request->estado;
        }
        if (isset($request->pais)) {
            $cliente->pais = $request->pais;
        }
        if (isset($request->rua)) {
            $cliente->rua = $request->rua;
        }
        if (isset($request->numero)) {
            $cliente->numero = $request->numero;
        }
        if (isset($request->bairro)) {
            $cliente->bairro = $request->bairro;
        }
        if (isset($request->cep)) {
            $cliente->cep = $request->cep;
        }
        if (isset($request->complemento)) {
            $cliente->complemento = $request->complemento;
        }




        $cliente->update();

        return response()->json([
            'status' => true,
            'message' => 'Cliente atualizado.'
        ]);
    }


    //Pesquisas



    public function pesquisarPorId($id)
    {
        $cliente = Clientes::find($id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "cliente não cadastrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $cliente
        ]);
    }



    public function pesquisarClientePorNome(Request $request)
    {
        $cliente = Clientes::where('nome', 'like', '%' . $request->nome . '%')->get();

        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Nenhum cliente foi encontrado'
        ]);
    }



    public function pesquisarClientePorCpf(Request $request)
    {
        $cliente = Clientes::where('cpf', '=',  $request->cpf)->first();

        if (isset($cliente)) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Nenhum CPF encontrado'
        ]);
    }

    public function pesquisarClientePorCelular(Request $request)
    {
        $cliente = Clientes::where('celular', 'like', '%' . $request->celular . '%')->get();

        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Nenhum celular foi encontrado'
        ]);
    }

    public function pesquisarClientePorEmail(Request $request)
    {
        $cliente = Clientes::where('email', '=', $request->email)->first();

        if (isset($cliente)) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Nenhum email foi encontrado'
        ]);
    }

    public function recuperarSenha(Request $request)
    {

        $cliente = Clientes::where('email', '=', $request->email)->first();

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Email invalido"

            ]);
        }

        if (isset($cliente->cpf)) {
           
            $cliente->password = Hash::make( $cliente->cpf );
            
        }
        $cliente->update();

        return response()->json([
            'status' => true,
            'password' => $cliente->password
        ]);
    }
}
