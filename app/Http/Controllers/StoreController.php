<?php

namespace App\Http\Controllers;

use App\Categorie;

use Illuminate\Http\Request;
use App\Product;
use App\Template;
use DB;
use Session;


class StoreController extends Controller
{
    public function __construct()
    {
        //load all variable categories to all method 
        // View::share('categories', Categorie::all());
        $this->template = Template::where("selected", '1')->first();
    }
    public function index()
    {
        // $list_categories = Categorie::all();
        // return view("store.index", compact('list_categories'));
        return view('templates.' . $this->template->folder . '.index');
    }

    public function product()
    {
        $product = Product::All();
        return view('templates.' . $this->template->folder . '.product', compact('product'));
    }
    public function search(Request $request)
    {
        $search = $request->get('search');
        if ($search != null) {
            $product = DB::table('products')
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('varian', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $search . '%')->get();
            return view('store.product', compact('product'));
        } else {
            $product = DB::table('products')->where('name', 'like', '%' . $search . '%')
                ->orWhere('varian', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $search . '%')->get();
            Session::flash("error", "Data not Found!");
            return view('store.product', compact('product'));
        }
    }

    public function aboute()
    {
        return view('templates.' . $this->template->folder . '.about');
    }
    // `public function show($id)
    // {
    //     $product = Store::find($id);
    //     return view('store.product_detail', compact('product'));
    // }`
    public function contact()
    {
        return view('templates.' . $this->template->folder . '.contact');
    }
    public function cart()
    {
        return view('templates.' . $this->template->folder . '.cart');
    }
    public function checkout()
    {
        return view('templates.' . $this->template->folder . '.checkout');
    }
}
