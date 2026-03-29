<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Afficher login

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return response()->view('auth.login')->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }
    // Traiter login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ]);
    }

    // Afficher inscription
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    // Traiter inscription
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => [
                'required',
                'email:rfc',
                'unique:users',
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['gmail.com', 'yahoo.com', 'yahoo.fr', 'outlook.com', 'hotmail.com'];
                    $domain = strtolower(substr(strrchr($value, '@'), 1));
                    if (!in_array($domain, $allowedDomains)) {
                        $fail("Seuls les emails @gmail.com, @yahoo.com, @outlook.com sont acceptés.");
                    }
                },
            ],
            'password' => 'required|min:5|confirmed',
            ], [
                'email.required'     => "L'email est obligatoire.",
                'email.unique'       => "Cet email est déjà utilisé.",
                'name.required'      => "Le nom est obligatoire.",
                'password.required'  => "Le mot de passe est obligatoire.",
                'password.min'       => "Le mot de passe doit contenir au moins 5 caractères.",
                'password.confirmed' => "Les mots de passe ne correspondent pas.",
            ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Compte créé avec succès ! Connectez-vous.');
    }

    // Logout

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }
}
