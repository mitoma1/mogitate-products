@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">
    {{-- パンくずリスト --}}
    <div class="text-sm text-gray-500 mb-4">
        <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline">商品一覧</a> > {{ $product->name }}
    </div>

    {{-- 編集フォーム --}}
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex flex-col md:flex-row gap-10">
            {{-- 左：画像 --}}
            <div class="w-full md:w-1/2 space-y-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">現在の画像</label>
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow">
                    @else
                    <p class="text-gray-500">画像が設定されていません</p>
                    @endif
                </div>

                <div>
                    <label for="image" class="block text-gray-700 font-semibold mb-1">画像を変更</label>
                    <input type="file" name="image" class="w-full border rounded p-2">
                </div>
            </div>

            {{-- 右：商品情報 --}}
            <div class="w-full md:w-1/2 space-y-4">
                {{-- 商品名 --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">商品名</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded p-2">
                </div>

                {{-- 値段 --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">値段</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border rounded p-2">
                </div>

                {{-- 季節 --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">季節</label>
                    <div class="flex gap-4 flex-wrap">
                        @foreach (['春', '夏', '秋', '冬'] as $season)
                        <label class="flex items-center gap-1">
                            <input type="checkbox" name="seasons[]" value="{{ $season }}"
                                {{ in_array($season, explode(',', $product->seasons)) ? 'checked' : '' }}>
                            <span>{{ $season }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- 商品説明 --}}
        <div class="mt-10">
            <label class="block text-gray-700 font-semibold mb-1">商品説明</label>
            <textarea name="description" rows="5" class="w-full border rounded p-3">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- ボタン群 --}}
        <div class="mt-8 flex justify-center gap-6">
            <a href="{{ route('products.index') }}" class="bg-gray-300 text-gray-800 py-2 px-6 rounded hover:bg-gray-400">戻る</a>
            <button type="submit" class="bg-green-500 text-white py-2 px-6 rounded hover:bg-green-600">変更を保存</button>
        </div>
    </form>

    {{-- 商品削除ボタン --}}
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white py-2 px-6 rounded hover:bg-red-600 mt-4">
            <i class="fa fa-trash"></i> ゴミ箱
        </button>
    </form>
</div>
@endsection