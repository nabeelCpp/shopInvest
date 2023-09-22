<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index() : View {
        $data['brands'] = Brand::count();
        $data['products'] = Product::count();
        return view('dashboard.index', $data);
    }
}
