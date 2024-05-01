<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\api\CadastroController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;



use App\Models\Models\Cadastro;




// Rotas protegidas por autenticação JWT
Route::middleware('api')->group(function () {
    Route::get('task/view/{id}', [TaskController::class, 'get']);
    Route::get('task', [TaskController::class, 'getList']);
    Route::post('task', [TaskController::class, 'store']);
    Route::put('task/update/{id}', [TaskController::class, 'update']);
    Route::delete('task/delete/{id}', [TaskController::class, 'destroy']);
    Route::post('task/search/{lembrete}', [TaskController::class, 'filterbyLembrete']);
    Route::post('task/pendency/{pendency}', [TaskController::class, 'filterBySituacao']);

    // Rota para visualizar informações do usuário autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('/login', function (Request $request) {
    $user = Cadastro::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'E-mail não encontrado'], 401);
    }

    if (!Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Senha incorreta'], 401);
    }

    $token = JWTAuth::fromUser($user);

    return response()->json([
        'data' => [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60 // Tempo de vida do token em segundos
        ]
    ]);
});


Route::post('/cadastro', [CadastroController::class, 'store']); // Para acessar as rotas de task, o usuário precisa estar autenticado. A rota de cadastro permite cadastrar um usuário novo
