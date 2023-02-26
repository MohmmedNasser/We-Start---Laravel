<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::latest('id')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::select(['id', 'name'])->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $slug = Str::slug($request->en_name);
        $count = Product::whereSlug($slug)->count();
        $slug = $slug . '-' . $count;

        DB::beginTransaction();

        try {

            $product = Product::create([
                'name' => '',
                'smalldesc' => '',
                'desc' => '',
                'slug' => $slug,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'category_id' => $request->category_id,
                'featured' => $request->input('featured', 0),
            ]);

            if ($request->has('image')) {
                $image = $request->file('image')->store('uploads/products', 'custom');
                $product->gallery()->create([
                    'path' => $image,
                    'feature' => 1,
                ]);
            }

            if ($request->has('album')) {
                foreach ($request->album as $file) {
                    $product->gallery()->create([
                        'path' => $file,
                        'feature' => 0,
                    ]);
                }
            }

            if ($request->has('variation')) {
                foreach ($request->variation as $type => $data) {
                    foreach ($data as $info)
                        $product->variations()->create([
                            'type' => $type,
                            'value' => $info['value'],
                            'extraprice' => $info['price'],
                        ]);
                }
            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return redirect()->route('admin.products.index')->with('msg', 'Product created Successfuly')->with('type', 'success');


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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        $categories = Category::select(['id', 'name'])->get();
//        $variations = $product->variations()->get()->toArray();
//        return $variations;

//        $gallery = $product->gallery()->get()->toArray();
        $product = $product->load('image', 'category', 'gallery', 'variations');
        return view('admin.products.edit', compact('categories', 'product'));
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
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add_image(Request $request) {
        return $request->file('file')->store('/uploads/products', 'custom');
    }

}
