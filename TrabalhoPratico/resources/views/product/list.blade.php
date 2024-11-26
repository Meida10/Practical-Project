<x-master>
 <x-slot name="header">
 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 {{ __('Product List') }}
 </h2>
 </x-slot>
 <div class="py-12">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
 <div class="p-6 text-gray-900">

 @if(session()->has('success'))
<div style="border-style:solid; background-color:green" role="alert">
 {{ session()->get('success') }}
 </div>
 @endif
 @if(session()->has('error'))
<div style="border-style:solid; background-color:red" role="alert">
{{ session()->get('error') }}
</div>
 @endif
 @if(Auth::check() && Auth::user()->hasRole('admin'))
 <form action="{{ route('products.create' )}}" method="GET">
 {{ csrf_field() }}
 <x-secondary-button type="submit">Novo</x-secondary-button>
</form>
@endif
 <table id="list">
 <thead>
 <tr>
 <th>Id</th>
 <th>Title</th>
 <th>Code</th>
 <th>Description</th>
 <th>Price</th>
 <th>Image</th>
 @if(Auth::check() && Auth::user()->hasRole('admin'))
 <td colspan="2"><b>Action</b></td>
@endif
 @if(Auth::check() && Auth::user()->hasRole('regular'))
 <th>Avaliar</th>
 @endif
 </tr>
 </thead>
 <tbody>
 @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->title }}</td>
        <td>{{ $product->code }}</td>
        <td>{{ $product->description }}</td>
        <td>{{ $product->price }}</td>
        <td><img src="{{ url('storage/'.$product->image) }}" alt="Bad"/></td>
		@if(Auth::check() && Auth::user()->hasRole('admin'))
		<td><a href="{{ route('products.edit',$product->id) }}">Edit</a></td>
		@endif
		@if(Auth::check() && Auth::user()->hasRole('admin'))
        <td>
            <form action="{{ route('products.destroy', $product->id)}}" method="post">
                {{ csrf_field() }}
                @method('DELETE')
                <x-secondary-button type="submit">Delete</x-secondary-button>
            </form>
        </td>
		@endif
		@if(Auth::check() && Auth::user()->hasRole('regular'))
        <td>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <label for="quantity">Quantidade:</label>
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit">Adicionar ao Carrinho</button>
            </form>
        </td>
		@endif
		@if(Auth::check() && Auth::user()->hasRole('regular'))
        <td>
            <form action="{{ route('ratings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <select name="rating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button type="submit">Avaliar</button>
            </form>
        </td>
		@endif
		@if(Auth::check() && Auth::user()->hasRole('regular'))
        <td>
    @php
        $totalRating = \App\Models\Rating::totalRatingForProduct($product->id);
    @endphp
    @if ($totalRating !== null)
        {{ number_format($totalRating, 1) }} / 5
    @else
        Sem avaliações
    @endif
</td>
@endif
    </tr>
@endforeach
 </tbody>
 </table>
<div class="sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
{{ $products->links()}}
</div>
 </div>
 </div>
 </div>
 </div>
</x-master>
