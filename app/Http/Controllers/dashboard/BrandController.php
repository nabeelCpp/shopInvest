<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\dashboard\ProductController;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\TryCatch;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        $data['title'] = "Brands";
        $data['brands'] = Brand::all();
        return view('dashboard.brands.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required||unique:brands',
        ]);
        $body = $request->post();
        try {
            DB::beginTransaction();
            Brand::create([
                'name' => $body['name']
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Brand created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique(Brand::class)->ignore($id)
            ]
        ]);
        $body = $request->post();
        try {
            DB::beginTransaction();
            $brand = Brand::find($id);
            if( !$brand ) {
                return redirect()->back()->with('error', 'No brand found!');
            }
            $brand->name = $body['name'];
            /**
             * Update the brand with updated values.
             */
            $brand->save();
            /**
             * Commit the transactions
             */
            DB::commit();
            return redirect()->back()->with('success', 'Brand updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ProductController $productController)
    {
        try {
            DB::beginTransaction();
            $brand = Brand::find($id);
            if( !$brand ) {
                return redirect()->back()->with('error', 'No brand found!');
            }
            /**
             * Fetch all the products we need to delete which are under the brand.
             */
            foreach ($brand->products as $key => $product) {
                $product->images()->delete();
                $product->delete();
                /**
                 * Remove the product directory.
                 */
                $productDir = public_path("uploads/products/{$product->id}");
                $productController->deleteDirectory($productDir);
            }
            $brand->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Brand deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
