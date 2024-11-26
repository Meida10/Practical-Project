<?php

// O controller está no namespace e os "use" servem para importar as classes necessárias
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
		// Carrega o carrinho com os produtos selecionados
        $cart = Cart::with('items.product')->firstOrCreate([]);
		$totalPrice = 0;
		// Percorre os produtos existentes no carrinho e calcula o preço total (soma do preço do produto multiplicado pela quantidade)
		foreach ($cart->items as $item) {
			$totalPrice += $item->product->price * $item->quantity;
		}
		// Retorna a view 'cart.index', com as variáveis 'cart' e 'totalPrice'
        return view('cart.index', compact('cart', 'totalPrice'));
    }

    public function add(Request $request, Product $product)
    {
		// Obtém o carrinho atual ou cria um novo se não existir nenhum
        $cart = Cart::firstOrCreate([]);

		// Obtém ou cria um item associado ao produto recebido
        $cartItem = $cart->items()->firstOrNew([
            'product_id' => $product->id,
        ]);
		// Incrementa a quantidade do produto de acordo com a quantidade recebida no request
        $cartItem->quantity += $request->input('quantity', 1);
		// Salva o produto adicionado na base de dados
        $cartItem->save();

		// Redireciona de volta para a página do carrinho
        return redirect()->route('cart.index');
    }

    public function remove(CartItem $cartItem)
    {
		// Apaga o produto do carrinho
        $cartItem->delete();
		// Redireciona de volta para a página do carrinho
        return redirect()->route('cart.index');
    }
}

?>