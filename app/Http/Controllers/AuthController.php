<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $isLogged = $this->authService->login($request);

        if (!$isLogged) {
            return back()
                ->withErrors([
                    'email' => 'Nieprawidłowy email, hasło lub konto jest nieaktywne.',
                ])
                ->withInput(); //wpisany przez użytkownika login i hasło zostanie w inpucie
        }

        return redirect()->route('dashboard.index');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->authService->register($request);

        return redirect()->route('dashboard.index')
            ->with('success', 'Konto zostało utworzone.');
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return redirect()->route('login')
            ->with('success', 'Zostałeś wylogowany.');
    }
}
