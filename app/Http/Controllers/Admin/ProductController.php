<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Str;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable) : View|JsonResponse
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request) : RedirectResponse
    {
        //dd($request->all());
        $imagePath = $this->uploadImage($request, 'image');
        $product = new Product();
        $product->thumbnail = $imagePath;
        $product->name = $request->name; //truffle fries
        $product->slug = generateUniqueSlug('Product', $request->name); //truffle-fries (convert actual name)
        //slug have to be unique
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price ?? 0;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        //$product->sku = $request->sku;
        //$product->seo_title = $request->seo_title;
        //$product->seo_description = $request->seo_description;
        $product->show_at_home = $request->show_at_home;
        $product->status = $request->status;
        $product->save();
        // dd(generateUniqueSlug('Product', $request->name));

        toastr()->success('Create Successfully');

        return to_route('admin.product.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id) : RedirectResponse
    {

        $product = Product::findOrFail($id);
        // dd($request->all());
        $imagePath = $this->uploadImage($request, 'image', $product->thumbnail);
        $product->thumbnail = !empty($imagePath) ? $imagePath : $product->thumbnail;
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price ?? 0;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        //$product->sku = $request->sku;
        //$product->seo_title = $request->seo_title;
        //$product->seo_description = $request->seo_description;
        $product->show_at_home = $request->show_at_home;
        $product->status = $request->status;
        $product->save();
        toastr()->success('Updated   Successfully');

        return to_route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        try{
            $product = Product::findOrFail($id);
            $this->removeImage($product->thumbnail);
            $product->delete();

            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        }catch(\Exception $e){
            return response(['status' => 'error', 'message' => 'Something went wrong!']);
        }
    }
}
