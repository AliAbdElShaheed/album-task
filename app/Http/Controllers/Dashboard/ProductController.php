<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{



    // Make Construct Function To Prevent Not Authorized Users That Not Have Permissions To Access Not Permission Pages
    public function __construct()
    {
        $this->middleware(['permission:products_read'])->only('index');
        $this->middleware(['permission:products_create'])->only(['create', 'store']);
        //$this->middleware(['permission:products_update'])->only(['edit', 'update']);
        $this->middleware(['permission:products_delete'])->only('destroy');
    } // End of Constructor


    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function ($q) use ($request) {

            return $q->where('name->en', 'like', '%' . $request->search . '%')

                ->orwhere('name->ar', 'like', '%'. $request->search . '%');

        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->latest()->paginate(5);

        return view('dashboard.products.index', compact('categories','products'));
    }  // End of Index



    public function create()
    {
        $categories = Category::all();

        return view('dashboard.products.create', compact('categories'));
    }  // End of Create



    public function store(Request $request)
    {
        //dd($request->all());

        // validation For Required Fields
        $request->validate([
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Adjust the validation rules as needed


        ]); // End of Validation


        // Prepare The Request Image Size & Save It
        if ($request->file('file')) {
            $image = $request->file('file');
            $image_name = $request->category_id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products_img/'), $image_name);
        } else {
            $image_name = 'default.png';

        }// End of IF

        // Save the file name to the database
        Product::create([
            'name' => $image_name,
            'category_id' => $request->category_id,
        ]);

        // return response()->json(['success' => $image_name]);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('products.index');

    }  // End of Store


    public function destroy($id)
    {
        //dd($id);
        $product = Product::find($id);

        // Delete The Product Image
        //dd(public_path('uploads/products_img/'));
        if ($product->image != 'default.png') {
            File::delete(public_path('uploads/Products_img/') . $product->image);
        }

        $product->delete();
        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('products.index');

    }  // End of Destroy


} // End of Controller
