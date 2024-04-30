<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Category;
use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        //dd('Welcome');
        $categories_count = Category::count();
        $products_count = Product::count();
        $users_count = User::whereRoleIs(['admin', 'user'])->count();

        return view('dashboard.index', compact('categories_count', 'products_count', 'users_count'));

    }//end of index

}//end of controller

