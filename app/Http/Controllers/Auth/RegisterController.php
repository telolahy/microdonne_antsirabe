<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    // Redirige après l'inscription
    protected $redirectTo = '/login'; // Changez la redirection selon vos besoins

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Affiche le formulaire d'inscription
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Gère l'inscription de l'utilisateur
    protected function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            // Affiche les erreurs de validation
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = $this->create($request->all());

        // Envoie un email de vérification
        $user->sendEmailVerificationNotification();
        
        $this->guard()->login($user);

        //return redirect($this->redirectPath()); 
        return redirect()->route('verification.notice'); // Redirige vers la page de notification de vérification
    }


    // Validation des données d'inscription
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:7', 'confirmed'],
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string'],
            'profession' => ['required', 'string', 'max:255'],
            'entite' => ['required', 'string', 'max:255'],
        ]);
    }

    // Crée l'utilisateur
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'prenom' => $data['prenom'],
            'adresse' => $data['adresse'],
            'telephone' => $data['telephone'],
            'profession' => $data['profession'],
            'entite' => $data['entite'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
