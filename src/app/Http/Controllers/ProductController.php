<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    // 商品一覧表示
    public function index(Request $request)
    {
        $query = Product::query();

        // 商品名での検索
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // 並び替え
        if ($request->has('sort_by')) {
            if ($request->sort_by === 'low_to_high') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort_by === 'high_to_low') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->paginate(6);


        return view('products.index', compact('products'));
    }

    // 商品詳細表示
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // 商品登録画面
    public function create()
    {
        return view('products.create');
    }

    // 商品登録処理
    public function store(ProductRequest $request)
    {
        // 画像を保存
        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'season' => json_encode($request->seasons),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', '商品が登録されました。');
    }

    // 商品編集画面
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // 商品更新処理
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        // 新しい画像がアップロードされた場合
        if ($request->hasFile('image')) {
            // 古い画像があれば削除（任意）
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }

            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = $path;
        }

        // JSONエンコード忘れずに
        if (isset($data['seasons'])) {
            $data['season'] = json_encode($data['seasons']);
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', '商品を更新しました');
    }

    // 商品削除処理
    public function destroy(Product $product)
    {
        // 画像削除（任意）
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }
}
