<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
		// Retorna a view "profile.edit" com os dados do utilizador, obtidos através do método "$request->user()"
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
		// Preenche os dados do utilizador
        $request->user()->fill($request->validated());
		
		// Verifica se o campo "email" foi modificado. Se tiver sido, define "email_verified_at" como null
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
		// Valida a password do utilizador através da função "validateWithBag" para garantir que a requisição é feita pelo próprio utilizador
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

		// Obtém o utilizador autenticado
        $user = $request->user();

		// Desconecta o utilizador
        Auth::logout();

		// Elimina a conta do utilizador
        $user->delete();

		// Invalida a sessão atual e regenera o token CSRF para segurança
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
