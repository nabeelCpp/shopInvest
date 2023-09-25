<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\{Product, Brand, Image};
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        $data['title'] = 'Products';
        $data['products'] = Product::all();
        return view('dashboard.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : View
    {
        $data['title'] = 'Add Product';
        $data['brands'] = Brand::all();
        return view('dashboard.products.create', $data);
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
           'name' => 'required',
           'price' => 'required|numeric|min:0.01',
           'brand' => 'required',
           'description' => 'required|min:15',
           'images' => [
                'required',
                'array',
                'min:1', // At least one file must be present
                'max:4',
            ],
            'images.*' => 'required|image',
        ], [
            'price.min' => 'The Product price must be greater than zero.',
            'description.min' => 'The description must be atleast 15 characters long.',
            'images.required' => 'Atleast one image file is required. Maximum 4 can be uploaded.',
            'images.*.mimes' => 'One or more files are not images. Files must be of type jpeg,png,gif,bmp,svg' 
        ]);
        try {
            $body = $request->post();
            DB::beginTransaction();
            /**
             * Check if brand exists or not.
             */
            $brand = Brand::find($body['brand']);
            if( !$brand ) {
                return redirect()->back()->with('error', 'No brand found!');
            }
            /**
             * Create new product
             */
            $productArr = [
                'name' => $body['name'],
                'price' => $body['price'],
                'description' => $body['description'],
                'brand_id' => $body['brand']
            ];
            $product = Product::create($productArr);

            /**
             * Image upload flow here
             */
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Handle each uploaded image here, e.g., store it, generate a unique filename, etc.
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path("uploads/products/{$product->id}"), $imageName); // Store the images in the specific 'products' directory
                    // Save the images name to database
                    Image::create([
                        'filename' => $imageName,
                        'product_id' => $product->id
                    ]);
                }
            }
            DB::commit();
            return redirect()->to('products')->with('success', 'Product created successfully!');
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
    public function edit($id) : View
    {
        $product = Product::find($id);
        if( !$product ) {
            return redirect()->back()->with('error', 'Product not found!');
        }
        $data['product'] = $product;
        $data['brands'] = Brand::all();
        $data['title'] = "Edit Product - {$product->name}";
        return view('dashboard.products.create', $data);
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
            'name' => 'required',
            'price' => 'required|numeric|min:0.01',
            'brand' => 'required',
            'description' => 'required|min:15',
        ], [
            'price.min' => 'The Product price must be greater than zero.',
            'description.min' => 'The description must be atleast 15 characters long.' 
        ]);
        /**
         * Run validations if image is included in request!
         */
        if ($request->hasFile('images')) {
            $request->validate([
                'images' => [
                     'required',
                     'array',
                     'min:1', // At least one file must be present
                     'max:4',
                 ],
                 'images.*' => 'required|image',
             ], [
                'images.required' => 'Atleast one image file is required. Maximum 4 can be uploaded.',
                'images.*.mimes' => 'One or more files are not images. Files must be of type jpeg,png,gif,bmp,svg' 
             ]);
        }
        try {
            $body = $request->post();
            DB::beginTransaction();

            /**
             * Fetch Product
             */
            $product = Product::find($id);

            if( !$product ) {
                return redirect()->back()->with('error', 'Product Not found!');
            }
            /**
             * Check if brand exists or not.
            */
            $brand = Brand::find($body['brand']);
            if( !$brand ) {
                return redirect()->back()->with('error', 'No brand found!');
            }

            $product->name = $body['name'];
            $product->description = $body['description'];
            $product->price = $body['price'];
            $product->brand_id = $body['brand'];
            /**
             * Update product
            */
            $product->save();

            /**
             * Image upload flow here
            */
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Handle each uploaded image here, e.g., store it, generate a unique filename, etc.
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path("uploads/products/{$product->id}"), $imageName); // Store the images in the specific 'products' directory
                    // Save the images name to database
                    Image::create([
                        'filename' => $imageName,
                        'product_id' => $product->id
                    ]);
                }
            }
            DB::commit();
            return redirect()->to('products')->with('success', 'Product Updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($id);
            if( !$product ) {
                return redirect()->back()->with('error', 'No Product found!');
            }
            $product->images()->delete();
            $product->delete();
            /**
             * Remove the product directory.
             */
            $productDir = public_path("uploads/products/{$id}");
            $this->deleteDirectory($productDir);
            DB::commit();
            return redirect()->back()->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function removeImage($id) {
        try {
            DB::beginTransaction();
            $image = Image::find($id);
            if( !$image ) {
                return redirect()->back()->with('error', 'Image not found!');
            }
            /**
             * Remove file from directory
             */
            $imagePath = public_path("uploads/products/{$image->product_id}/{$image->filename}");
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
            /**
             * Delete file from database
             */
            $image->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Gallery item removed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteDirectory($dirPath) {
        if (is_dir($dirPath)) {
            $files = glob($dirPath . '/*');
            foreach ($files as $file) {
                if (is_dir($file)) {
                    $this->deleteDirectory($file); // Recursively delete subdirectories
                } else {
                    unlink($file); // Delete individual files
                }
            }
            rmdir($dirPath); // Delete the empty directory
        }
    }
}
