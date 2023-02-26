<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeCategoriesResource;
use App\Http\Resources\ProductsResource;
use App\Mail\ContactMail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use function Symfony\Component\VarDumper\Dumper\esc;

class SiteController extends Controller
{
    public function contact(Request $request) {
//        return $request->all();

        $data = $request->except('cv');
        $cv = $request->file('cv')->store('uploads/cv', 'custom');
        $data['cv'] = $cv;

//        Mail::to('admin@admin.com')->send(new ContactMail($request->all()));
//        Mail::to('moh.jamil1993@gmail.com')->send(new ContactMail($data));
        Mail::to('moh.jamil1993@gmail.com')->queue(new ContactMail($data));
        /*
         * don't forget change QUEUE_CONNECTION=database in .env file
         */
    }

    public function home_categories() {
//        $data = Category::query()->withWhereHas('products', function () {
//        })->get();

        $data = Category::query()->has('products')->withCount('products')->orderByDesc('products_count')->limit(6)->get();

        $data = HomeCategoriesResource::collection($data);

        return BaseController::msg(1,'All Categories with Products', 200, $data);
    }

    public function products(Request $request) {
        $data = ProductsResource::collection(Product::with('image', 'gallery', 'variations', 'category')->get());
        return BaseController::msg(1, "All Products", 200, $data);
    }

    public function product($slug) {
        $data = new ProductsResource(Product::query()->where('slug', $slug)->with('image', 'gallery', 'variations', 'category')->first());

        return BaseController::msg(1, "get product Info", 200, $data);


    }


    public function add_to_cart(Request $request) {
        $product = Product::find($request->product_id);

        Cart::query()->updateOrCreate([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,

        ], [
            'quantity' => DB::raw('quantity +' . $request->quantity),
            'price' => $product->price
        ]);
    }

    public function cart(Request $request) {
        return Cart::query()->where('user_id', $request->user_id)->get();
    }


//    public function add_to_user(Request $request) {
//        Cart::query()->where('user_id', $request->user_token)->update(['user_id' => $request->user_id]);
//        return Cart::query()->where("user_id", $request->user_id)->get();
//    }

    public function verify_otp(Request $request) {

        $code = implode($request->number);
        $user = $request->user();

        $update = User::query()->where('id', $user->id)->where('otp_code', $code)->update(['otp_verified_at' => now()]);

        if($update) {
            return now();
        } else {
            return BaseController::msg(0,'You Otp is invalid', 422);
        }
    }

}
