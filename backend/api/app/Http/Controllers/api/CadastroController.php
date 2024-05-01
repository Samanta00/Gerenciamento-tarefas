<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Cadastro;
use App\Models\Models\Login;
use App\Services\CadastroService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




class CadastroController {
    private $cadastroService;

    public function __construct(CadastroService $cadastroService) {
        $this->cadastroService = $cadastroService;
    }

    public function store(Request $request)
    {
        $emailExists = Cadastro::where('email', $request->email)->exists();

        if ($emailExists) {
            return response()->json(['message' => 'E-mail already exists'], 422);
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $this->cadastroService->store($data);
        return response()->json(['message'=> 'cadastro realizado com sucesso!'], 201);
    }


    public function getInformations(Request $request)
    {
        $user = Login::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json(['message' => 'E-mail not found'], 404);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid password'], 401);
        }
    
        // As credenciais são válidas, você pode gerar o token aqui
        $token = $user->createToken('AuthToken')->accessToken;
    
        return response()->json([
            'data' => [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]
        ]);
    }

    public function getList() {
        
        return $this->cadastroService->getList();
    }

    public function get($id) {
        return $this->cadastroService->get($id);
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        return $this->cadastroService->update($data, $id);
    }

    public function destroy($id) {
      
        return $this->cadastroService->destroy($id);
 
     }


     
     
     
}