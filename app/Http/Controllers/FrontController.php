<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FrontController extends Controller
{
    function index() : View {
        $data['brands'] = Brand::take(8)->get();
        $data['products'] = Product::take(25)->orderBy('id', 'DESC')->get();
        $data['title'] = config('app.name').' - HomePage';
        $data['hero'] = true;
        return view('landing', $data);
    }

    function product($id) : View | RedirectResponse {
        try {
            $product = Product::find($id);
            if(!$product) {
                throw new NotFoundHttpException();
            }
            $data['product'] = $product;
            $data['title'] = config('app.name')." - {$product->name}";
            $data['brands'] = Brand::take(8)->get();
            $data['related'] = Product::where('id', '!=', $id)->where('brand_id', $product->brand_id)->take(10)->get();
            return view('product', $data);
        } catch (\Throwable $th) {
            throw new NotFoundHttpException();
        }
    }


    function brand($brand) : View | RedirectResponse {
        try {
            //code...
            $brand = Brand::where(['name' => $brand])->first();
            $data['brand'] = $brand;
            $data['brands'] = Brand::take(8)->get();
            $data['products'] = $brand->products;
            $data['title'] = config('app.name').' - '.$brand->name;
            $data['hero'] = true;
            return view('landing', $data);
        } catch (\Throwable $th) {
            throw new NotFoundHttpException();
        }
    }
}
