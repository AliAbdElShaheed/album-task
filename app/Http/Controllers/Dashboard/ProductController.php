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
        $this->middleware(['permission:products_update'])->only(['edit', 'update']);
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
        // dd($image_name);

        // Save the file name to the database
        Product::create([
            'name' => $image_name,
            'category_id' => $request->category_id,
        ]);

        // return response()->json(['success' => $image_name]);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('products.index');

    }  // End of Store





    public function show(Product $product)
    {
        //
    }  // End of Show






    public function edit($id)
    {
        //dd($id);
        $categories = Category::all();
        $product = Product::find($id);
        //dd($product->name);

        return view('dashboard.products.edit', compact('categories', 'product'));

    } // End of Edit






    public function update(Request $request, $id)
    {
        //dd($id);
        $product = Product::find($id);
        //dd($product);

        // validation For Required Fields
        $request->validate([
            'name' => 'required',
            'name_ar' =>'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'category_id' => 'required'

        ]); // End of Validation

        $request_data = $request->all();

        //dd($request_data);

        // Prepare The Request Image Size & Save It
        if ($request->image) {

            if ($product->image != 'default.png') { // To Delete The Old Product Image
                File::delete(public_path('uploads/products_img/') . $product->image);
            } // End of Inner IF

            // To Save The New Product Image (Update It)
            Image::make($request->image)->resize(226, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/products_img/' . $request->image->hashName()), 80, 'png');

            $request_data['image'] = $request->image->hashName();
        } // End of IF
        //dd($request_data['image']);

        $product->name = ['en' => $request_data['name'], 'ar' => $request_data['name_ar']];
        $product->description = ['en' => $request_data['description'], 'ar' => $request_data['description_ar']];
        if ($request->image) {$product->image = $request_data['image'];};
        $product->purchase_price = $request_data['purchase_price'];
        $product->sale_price = $request_data['sale_price'];
        $product->stock = $request_data['stock'];
        $product->category_id = $request_data['category_id'];

        $product->update();

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('products.index');
    } // End of Update






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
