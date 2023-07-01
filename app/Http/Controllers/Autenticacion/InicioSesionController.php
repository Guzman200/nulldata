<?php

namespace App\Http\Controllers\Autenticacion;

use App\Http\Controllers\Controller;
use App\Http\Requests\autenticacion\ChangePasswordRequest;
use App\Http\Requests\autenticacion\LoginRequest;
use App\Http\Requests\autenticacion\RecoverPasswordRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Mail\estandarMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InicioSesionController extends Controller
{
    
    public function index(Request $request)
    {

        if(Auth::check()){
            return redirect()->route('home');
        }
       
        return view('autenticacion.inicio_sesion');
    }

    /**
     * @todo tarea programada para suspeciones
     */
    public function login(LoginRequest $request)
    {

        //return $request->only(['email', 'password']);
        
        if($request->ajax()){

            $accces = ['email' => 'admin@admin.com', 'password' => 'admin'];
            //$request->only(['email', 'password'];
      
            if (Auth::attempt($accces, $request->remember)) {

                $user = User::where('email', $request->email)->first();
    
                return response()->json($user,200);
            }

            return response()->json(['mensaje' => 'Credenciales incorrectas'],422);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return response()->json([],200);
    }

    public function register(RegisterRequest $request)
    {

        User::create([
            'nombre' => $request->nombre,
            'password' => Hash::make($request->password),
            'email' => $request->username
        ]);

        return response()->json(['title' => 'Usuario registrado correctamente']);
    }

    public function sendEmail(RecoverPasswordRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        $token = Str::random(60);

        $user->token = $token;
        $user->update();

        $url = route("cambiar_password", ['token' => $token, 'email' => $request->email]);

        Mail::to($request->email)->send(
            new estandarMail("Recuperación de contraseña", 
                "Ha solicitador una recuperación de contraseña", "Restaurar contraseña", $url, "Restauración de contraseña")
        );

        return response()->json([]);

    }

    public function changePassword(ChangePasswordRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        $user->password = Hash::make($request->password);
        $user->token = "";
        $user->update();

        return response()->json([]);
    }
}
