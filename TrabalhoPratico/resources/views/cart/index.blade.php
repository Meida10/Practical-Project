<!DOCTYPE html>
<html>
<head>
    <title>Carrinho de Compras</title>
    <style>
        .product-image {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Carrinho de Compras</h1>
    @if($cart->items->isEmpty())
        <p>O carrinho está vazio.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Preço Total</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart->items as $item)
                    <tr>
                        <td>
                            <img src="{{ url('storage/' . $item->product->image) }}" alt="Imagem do Produto" class="product-image"/>
                        </td>
                        <td>{{ $item->product->title }}</td>
                        <td>{{ $item->product->description }}</td>
                        <td>{{ $item->product->price }}€</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product->price * $item->quantity }}€</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
		<p>Preço Total do Carrinho: {{ $totalPrice }}€</p>
    @endif
    <a href="/laravel/products">Voltar aos produtos</a>
</body>
</html>