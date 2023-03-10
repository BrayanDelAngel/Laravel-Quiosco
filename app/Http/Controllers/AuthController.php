<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login (LoginRequest $request){
        
        $data=$request->validated();
        //Revisar el password
        //422 respuesta de error de los datos
        if(!Auth::attempt($data)){
            return response([
                'errors'=>['El email o la contraseña son incorrectos']
            ],422);
        }
        //Autenticar usuario
        $user=Auth::user();
        //Retorna una respuesta
        return [
            'token'=>$user->createToken('token')->plainTextToken,
            'user'=>$user
        ];
    }
    public function registrer (RegistrerRequest $request){
        //Validar el registro
        $data = $request->validated();
        //Crear el usuario
        $user=User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
        ]);
        //Retorna una respuesta
        return [
            'token'=>$user->createToken('token')->plainTextToken,
            'user'=>$user
        ];
    }
    public function logout (Request $request){
        $user =$request->user();
        $user->currentAccessToken()->delete();
        return [
            'user'=>null
        ];
        
    }
}
