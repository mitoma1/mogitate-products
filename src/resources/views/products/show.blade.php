@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">
    {{-- パンくずリスト --}}
    <div class="text-sm text-gray-500 mb-4">
        <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline">商品一覧</a> > {{ $product->name }}
    </div>

    {{-- メインの2カラム構成 --}}
    <div class="flex flex-col md:flex-row gap-10">
        {{-- 左：画像 --}}
        <div class="w-full md:w-1/2">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow">
        </div>

        {{-- 右：商品情報 --}}
        <div class="w-full md:w-1/2 space-y-4">
            {{-- 商品名 --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-1">商品名</label>
                <input type="text" value="{{ $product->name }}" class="w-full border rounded p-2 bg-gray-100" readonly>
            </div>

            {{-- 値段 --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-1">値段</label>
                <input type="text" value="{{ $product->price }}" class="w-full border rounded p-2 bg-gray-100" readonly>
            </div>

            {{-- 季節 --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-1">季節</label>
                <div class="flex gap-4">
                    @foreach (['春', '夏', '秋', '冬'] as $season)
                    <label class="flex items-center gap-1">
                        <input type="checkbox" disabled {{ in_array($season, explode(',', $product->seasons)) ? 'checked' : '' }}>
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
        <textarea rows="5" class="w-full border rounded p-3 bg-gray-100" readonly>{{ $product->description }}</textarea>
    </div>

    {{-- ボタン群 --}}
    <div class="mt-8 flex justify-center gap-6">
        <a href="{{ route('products.index') }}" class="bg-gray-300 text-gray-800 py-2 px-6 rounded hover:bg-gray-400">戻る</a>

        {{-- 商品削除ボタン --}}
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('削除してよろしいですか？')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-800 text-2xl">
                <i class="fas fa-trash-alt"></i> 削除
            </button>
        </form>
    </div>
</div>
@endsection