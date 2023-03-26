<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index()
    {
        return view('login/login');
    }

    public function login(Request $request)
    {
        $credenciales = [];
        $datos = $request->validate([
            'usuario' => ['required', 'string'],
            'password' => ['required', 'string'],
        ],[
            'usuario.required' => '¡Digite el usuario!',
            'password.required' => '¡Digite la contraseña!',
        ]);

        if (intval($datos['usuario'])) {
            $credenciales = [
                'cedula' => $datos['usuario'],
                'password' => $datos['password'],
                'activo' => 1
            ];
        } else {
            $credenciales = [
                'username' => $datos['usuario'],
                'password' => $datos['password'],
                'activo' => 1
            ];
        }

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }else{
            return redirect()->back()->withErrors(['usuario' => '¡Credenciales incorrectas!']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
