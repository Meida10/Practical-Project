<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Obtém o ID do utilizador através da função "Auth::id()" | Obtém o ID do produto da requisição através da função "$request->input('product_id')" | Verifica se já existe uma avaliação feita por esse utilizador para o mesmo produto
        $userId = Auth::id();
        $productId = $request->input('product_id');
        $existingRating = Rating::where('user_id', $userId)->where('product_id', $productId)->first();
		
		// Se já existir uma avaliação, redireciona o utilizador para a página anterior com uma mensagem de erro
        if ($existingRating) {
            return redirect()->back()->with('error', 'Já avaliaste este produto anteriormente. Só podes avaliar cada produto uma vez.');
        }

        // Cria uma nova instância do model Rating | Define os campos user_id, product_id e rating com os dados obtidos | Guarda a avaliação na base de dados
        $rating = new Rating();
        $rating->user_id = $userId;
        $rating->product_id = $productId;
        $rating->rating = $request->input('rating');
        $rating->save();

        return redirect()->back()->with('success', 'Produto avaliado com sucesso.');
    }
}