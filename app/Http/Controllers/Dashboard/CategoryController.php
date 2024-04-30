<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{


    // Make Construct Function To Prevent Not Authorized Users That Not Have Permissions To Access Not Permission Pages
    public function __construct()
    {
        $this->middleware(['permission:categories_read'])->only('index');
        $this->middleware(['permission:categories_create'])->only(['create', 'store']);
        $this->middleware(['permission:categories_update'])->only(['edit', 'update']);
        $this->middleware(['permission:categories_delete'])->only('destroy');
    } // End of Constructor







    public function index(Request $request)
    {

        $categories = Category::when($request->search, function ($q) use ($request) {

            return $q->where('name->en', 'like', '%' . $request->search . '%')

                ->orwhere('name->ar', 'like', '%'. $request->search . '%');

        })->latest()->paginate(5);

        return view('dashboard.categories.index', compact('categories'));

    } // End of Index




    public function create()
    {

        return view('dashboard.categories.create');
    } //End of Create




    public function store(Request $request)
    {
        //dd($request->all());

        // validation on Category Names are Required
        $request->validate([
            'name' => 'required',
            'name_ar' =>'required',
        ]); // End of Validation

        //validation on Category Name if Exist
        if (Category::where('name->ar', $request->name_ar)->orwhere('name->en', $request->name)->exists()) {

            return redirect()->back()->withErrors(__('message.Exist'));
        } // End Of Validation IF

        $category = new Category(); // This is an Eloquent model
        /*
        $category
            ->setTranslation('name', 'en', $request->name)
            ->setTranslation('name', 'ar', $request->name_ar)
            ->save();*/

        $category->name = ['en' => $request->name, 'ar' => $request->name_ar];
        $category->notes = $request->notes;
        $category->save();

        //Category::create($request->all());

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('categories.index');
    }  // End of Store




/*
    public function show(Category $category)
    {
        //
    }*/




    public function edit($id)
    {
        //dd($id);
        $category = Category::find($id);
        //dd($category['name']);

        return view('dashboard.categories.edit', compact('category'));

    } // End of Edit





    public function update(Request $request, $id)
    {
        //dd($request);
        //dd($id);
        $category =Category::find($id);
        //dd($category);

        // validation on Category Names are Required
        $request->validate([
            'name' => 'required',
            'name_ar' =>'required',
        ]); // End of Validation

        //validation on Category Name if Exist But ignore its names
        /*
        if (Category::where('name->ar', $request->name_ar)->orwhere('name->en', $request->name)->where('id', $id )->exists()) {

            return redirect()->back()->withErrors(__('message.Exist'));
        } // End Of Validation IF*/

        $category->name = ['en' => $request->name, 'ar' => $request->name_ar];
        $category->notes = $request->notes;
        /*
        $category
            ->setTranslation('name', 'en', $request->name)
            ->setTranslation('name', 'ar', $request->name_ar)
            ->save();*/
        //dd($category);
        $category->update();

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('categories.index');
    } // End of Update






    public function destroy( $id)
    {
        //dd($id);
        $category =Category::find($id);
        //dd($category['name']);

        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('categories.index');
    }  // End of Destroy



} // End of Controller
