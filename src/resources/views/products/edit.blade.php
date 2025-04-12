<form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
    @extends('layouts.app')

    @section('content')
    <div class="w-full max-w-3xl mx-auto p-8 bg-white shadow rounded">
        <h2 class="text-xl font-bold mb-4">商品編集</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- 商品画像 -->
            <div class="mb-4">
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="商品画像" class="w-48 mb-2">
                <input type="file" name="image">
                @error('image')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
            </div>

            <!-- 商品名 -->
            <div class="mb-4">
                <label>商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="border w-full p-2">
                @error('name')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
            </div>

            <!-- 値段 -->
            <div class="mb-4">
                <label>値段</label>
                <input type="text" name="price" value="{{ old('price', $product->price) }}" class="border w-full p-2">
                @error('price')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
            </div>

            <!-- 季節 -->
            <div class="mb-4">
                <label>季節</label><br>
                @foreach(['春', '夏', '秋', '冬'] as $season)
                <label class="mr-4">
                    <input type="checkbox" name="seasons[]" value="{{ $season }}"
                        {{ in_array($season, old('seasons', $product->seasons ?? [])) ? 'checked' : '' }}> {{ $season }}
                </label>
                @endforeach
                @error('seasons')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
            </div>

            <!-- 商品説明 -->
            <div class="mb-4">
                <label>商品説明</label>
                <textarea name="description" rows="4" class="border w-full p-2">{{ old('description', $product->description) }}</textarea>
                @error('description')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
            </div>

            <!-- ボタン -->
            <div class="flex justify-between items-center">
                <a href="{{ route('products.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">戻る</a>
                <div>
                    <button type="submit" class="bg-yellow-400 px-4 py-2 rounded">変更を保存</button>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block ml-2"
                        onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 text-xl">🗑️</button>
                    </form>
                </div>
            </div>
        </form>
    </div>
    @endsection