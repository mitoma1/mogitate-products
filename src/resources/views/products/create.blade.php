<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">

<body>

    <div class="form-container">
        <h2>商品登録</h2>

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- 商品名 -->
            <div class="form-group">
                <label for="name">商品名 <span class="required">*</span></label>
                <input type="text" id="name" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
                @error('name') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <!-- 値段 -->
            <div class="form-group">
                <label for="price">値段 <span class="required">*</span></label>
                <input type="text" id="price" name="price" placeholder="値段を入力" value="{{ old('price') }}">
                @error('price') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <!-- 商品画像 -->
            <div class="form-group">
                <label for="image">商品画像 <span class="required">*</span></label>
                <input type="file" id="image" name="image">
                @error('image') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            　　　<!-- 季節 -->
            　　　<div class="form-group">
                　　<label>季節 <span class="required">※複数選択可</span></label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="seasons[]" value="春" {{ is_array(old('seasons')) && in_array('春', old('seasons')) ? 'checked' : '' }}> 春</label>
                    <label><input type="checkbox" name="seasons[]" value="夏" {{ is_array(old('seasons')) && in_array('夏', old('seasons')) ? 'checked' : '' }}> 夏</label>
                    <label><input type="checkbox" name="seasons[]" value="秋" {{ is_array(old('seasons')) && in_array('秋', old('seasons')) ? 'checked' : '' }}> 秋</label>
                    <label><input type="checkbox" name="seasons[]" value="冬" {{ is_array(old('seasons')) && in_array('冬', old('seasons')) ? 'checked' : '' }}> 冬</label>
                </div>
                @error('seasons') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <!-- 商品説明 -->
            <div class="form-group">
                <label for="description">商品説明 <span class="required">*</span></label>
                <textarea id="description" name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                @error('description') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="back-btn">戻る</a>
                <button type="submit" class="submit-btn">登録</button>
            </div>
        </form>
    </div>

</body>

</html>