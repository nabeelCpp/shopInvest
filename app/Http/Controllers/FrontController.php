<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FrontController extends Controller
{
    function index() : View {
        $data['brands'] = Brand::take(2)->get();
        $data['products'] = Product::take(25)->orderBy('id', 'DESC')->get();
        $data['title'] = 'SHOPINVEST - HomePage';
        $data['hero'] = true;
        return view('landing', $data);
    }

    function product($id) : View {
        $product = Product::find($id);
        if(!$product) {
            throw new NotFoundHttpException();
        }
        $data['product'] = $product;
        $data['title'] = "SHOPINVEST - {$product->name}";
        $data['brands'] = Brand::take(2)->get();
        $data['related'] = Product::where('id', '!=', $id)->where('brand_id', $product->brand_id)->take(10)->get();
        return view('product', $data);
    }
}
