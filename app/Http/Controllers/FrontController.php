<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\FrontService;

class FrontController extends Controller
{
    //
    protected $frontService;

    public function __construct(FrontService $frontService)
    {
        $this->frontService = $frontService;
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = $this->frontService->searchProducts($keyword);

        return view('front.search', ['products' => $products, 'keyword' => $keyword,]);
    }

    public function index()
    {
        $data = $this->frontService->getFrontPageData();
        return view('front.index', $data);
    }

    public function details(Product $product){
        $category = $product->category;
        return view('front.details', compact('product', 'category'));
    }

    public function category(Category $category){
        return view('front.category', compact('category'));
    }
}
