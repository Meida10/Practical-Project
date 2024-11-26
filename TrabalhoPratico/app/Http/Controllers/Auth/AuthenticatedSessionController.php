<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
	 
	// Este método trata uma requisição de autenticação
    public function store(LoginRequest $request): RedirectResponse
    {
		// Autentica o utilizador com base nas informações fornecidas
        $request->authenticate();

        $request->session()->regenerate();
		
		// Adiciona uma lista de todos os utilizadores à sessão
		$request->session()->put('usersList',User::all());
		
		// Redireciona o utilizador para a página pretendida e, se não houver página pretendida, redireciona para a dashboard
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
		// Desconecta o utilizador
        Auth::guard('web')->logout();
		
		// Invalida a sessão atual
        $request->session()->invalidate();

		// Regenera o token CSRF para a segurança da sessão
        $request->session()->regenerateToken();

		// Redireciona o utilizador para a página inicial após dar logout
        return redirect('/');
    }
}
