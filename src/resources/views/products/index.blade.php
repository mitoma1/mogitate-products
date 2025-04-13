@extends('layouts.app')

@section('page-css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品一覧</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-success">+ 商品を追加</a>
    </div>

    <div class="row mt-4">
        {{-- 左：検索フォーム --}}
        <div class="col-md-3 mb-4">
            <form method="GET" action="{{ route('products.index') }}">
                {{-- 商品名で検索 --}}
                <div class="form-group mb-3">
                    <label for="name" class="fw-bold fs-5">商品一覧</label>
                    <input type="text" name="name" id="name" class="form-control rounded-pill" placeholder="商品名で検索" value="{{ request('name') }}">
                </div>

                {{-- 検索ボタン --}}
                <div class="mb-4">
                    <button type="submit" class="btn btn-warning w-100 rounded-pill fw-bold">検索</button>
                </div>

                {{-- 並び替えセレクト --}}
                <div class="form-group">
                    <label for="sort_by" class="fw-bold">価格順で表示</label>
                    <select name="sort_by" id="sort_by" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">価格で並べ替え</option>
                        <option value="high_to_low" {{ request('sort_by') == 'high_to_low' ? 'selected' : '' }}>価格が高い順</option>
                        <option value="low_to_high" {{ request('sort_by') == 'low_to_high' ? 'selected' : '' }}>価格が安い順</option>
                    </select>
                </div>
            </form>
        </div>


        {{-- 右：商品カードとタグ --}}
        <div class="col-md-9">

            <!-- 並び替え条件タグ -->
            @if(request('sort_by'))
            <div class="mb-3">
                <span class="badge bg-info text-dark">
                    {{ request('sort_by') === 'high_to_low' ? '価格が高い順' : '価格が安い順' }}
                    <!-- ×ボタンでソートを解除 -->
                    <a href="{{ route('products.index', request()->except('sort_by', 'page')) }}" class="text-dark ms-2 text-decoration-none">&times;</a>
                </span>
            </div>
            @endif

            <!-- 商品カード -->
            <div class="row">
                @foreach ($products as $product)

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="{{ route('products.show', $product->id) }}">
                            <!-- 商品画像 -->
                            <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">

                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">¥{{ number_format($product->price) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- ページネーション -->
            <div class="mt-4">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection