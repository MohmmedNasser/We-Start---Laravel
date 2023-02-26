<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $categories = Category::latest('id')->paginate(10);
//        $categories = Category::withoutGlobalScope('parents')->latest('id')->paginate(10);
//        $categories = Category::parents()->latest('id')->paginate(10);
        $categories = Category::query()->latest('id')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select(['id', 'name'])->get();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
//        dd($request->all());
        $image = $request->file('image')->store('uploads/categories', 'custom'); // custom is disk

        $categoy = Category::create([
            'name' => '', // name get value from Mutator (setNameAttribute)

        /*
         * * added slug using CategoryObserver with creating function
         */

//            'slug' => Str::slug($request->en_name),
            'parent_id' => $request->parent_id,
        ]);

        $categoy->image()->create([
            'path' => $image,
            'feature' => 1,
        ]);

        return redirect()->route('admin.categories.index')->with('msg', 'Category created successfully')->with('type', 'success');

    }


    public function show(Category $category)
    {
        return $category->load('parent', 'image');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
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
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => '',
            'parent_id' => $request->parent_id
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image')->store('uploads/categories', 'custom');
            $category->image()->update([
                'path' => $image
            ]);
        }
        // return $category;
        return $category->load('parent', 'image');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        File::delete(public_path($category->image->path));
        $category->image()->delete();
        $category->delete();

        return redirect()->back();
    }
}
