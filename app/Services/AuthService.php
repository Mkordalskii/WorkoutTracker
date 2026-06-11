<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => true
        ]);

        Auth::login($user);
        return $user;
    }

    public function login(Request $request):bool
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        //dane uwierzytelniające
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //Auth::attemp robi 4 rzeczy: wyszukuje użytkownika po credentials, weryfikuje zahashowane hasło, loguje i tworzy sesje, zwraca true/false
         if (!Auth::attempt($credentials)) {
            return false;
        }

        //zwraca obiekt aktualnie zalogowanego użytkownika (model)
        $user = Auth::user();

        if (!$user->is_active) {
            Auth::logout();
            return false;
        }

        //wygenerowanie nowego identyfikatora sesji dla bezpieczeństwa(anty atak Session Fixation) przy jednoczesnym zachowaniu jego danych z sesji
        $request->session()->regenerate();

        return true;
    }

    public function logout(Request $request): void
    {
        Auth::logout();
        $request->session()->invalidate();//usuwa wszystkie dane z sesji i niszczy stary identyfikator sesji
        $request->session()->regenerateToken();//generuje nowy token @CSRF(Cross-Site Request Forgery) sprawdzany przy POST,PUT i DELETE
    }
}