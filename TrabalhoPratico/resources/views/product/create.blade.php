<x-master>
 <x-slot name="header">
 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 {{ __('New Product') }}
 </h2>
 </x-slot>
 <div class="py-12">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
 <div class="md-full max-w-xs">

 <form class="w-full max-w-lg" method="POST" action="{{ route('products.store')}}" enctype="multipart/form-data">
 @csrf
 <div class="flex flex-wrap -mx-3 mb-6">´
 <div class="sm-full md:w-1/2 px-3 mb-6 md:mb-0">
 <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">Title</label>
 <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4
mb-3 leading-tight focus:outline-none focus:bg-white @error('title') is-invalid @enderror" name="title" id="title" type="text"
placeholder="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
 @error('title')
 <span class="text-red-500 text-xs italic" role="alert">
 <strong>{{ $message }}</strong>
 </span>
 @enderror

 <div class="flex flex-wrap -mx-3 mb-6">
 <div class="sm-full md:w-1/2 px-3 mb-6 md:mb-0">
 <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">Code</label>
 <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3
leading-tight focus:outline-none focus:bg-white @error('code') is-invalid @enderror" name="code" id="code"
value="{{ old('code') }}" type="text" placeholder="code" required autocomplete="title" autofocus>
 @error('code')
 <span class="text-red-500 text-xs italic" role="alert">
 <strong>{{ $message }}</strong>
 </span>
 @enderror

 <div class="flex flex-wrap -mx-3 mb-6">
 <div class="sm-full md:w-1/2 px-3 mb-6 md:mb-0">
 <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">Description</label>
 <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3
leading-tight focus:outline-none focus:bg-white @error('description') is-invalid @enderror" name="description"
id="description" placeholder="description" rows="4" cols="50" required autocomplete="title"
autofocus>{{ old('description') }}</textarea>
 @error('description')
 <span class="text-red-500 text-xs italic" role="alert">
 <strong>{{ $message }}</strong>
 </span>
 @enderror

 <div class="flex flex-wrap -mx-3 mb-6">
 <div class="sm-full md:w-1/2 px-3 mb-6 md:mb-0">
 <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">Price</label>
 <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3
leading-tight focus:outline-none focus:bg-white @error('price') is-invalid @enderror" name="price" id="price" type="text"
value="{{ old('price') }}" placeholder="price" required autocomplete="price" autofocus>
 @error('price')
 <span class="text-red-500 text-xs italic" role="alert">
 <strong>{{ $message }}</strong>
 </span>
 @enderror

 <div class="flex flex-wrap -mx-3 mb-6">
 <div class="sm-full md:w-1/2 px-3 mb-6 md:mb-0">
 <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="image">Image</label>
 <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4
mb-3 leading-tight focus:outline-none focus:bg-white @error('image') is-invalid @enderror" name="image" id="image"
type="file" placeholder="image name">
 @error('image')
 <span class="text-red-500 text-xs italic" role="alert">
 <strong>{{ $message }}</strong>
 </span>
 @enderror
 </div>
</div>
 <div class="flex flex-wrap -mx-3 mb-6">
 <div class="sm-full md:w-1/2 px-3 mb-6 md:mb-0">
 <button type="submit" class="btn btn-primary">
 {{ __('Submit') }}
 </button>

 </div>
 </div>
 </form>

 </div>
 </div>
 </div>
 </div>
</x-master>
