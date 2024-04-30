<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\ImageManagerStatic as Image;


class UserController extends Controller
{

    // Make Construct Function To Prevent Not Authorized Users That Not Have Permissions To Access Not Permission Pages
    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only(['create', 'store']);
        $this->middleware(['permission:users_update'])->only(['edit', 'update']);
        $this->middleware(['permission:users_delete'])->only('destroy');
    } // End of Constructor



    public function index(Request $request)
    {
        //$users = User::all();
        //$users = User::whereRoleIs(['admin', 'user'])->get();

        //dd($request->search);

        // This Is working But Isn't a Professional Way To Do The Search
        /*
        if ($request->search) {
            // dd($request->all());
            $users = User::where('name', 'like', '%' . $request->search  . '%')
            ->orwhere('email', 'like', '%'. $request->search . '%')
            ->whereRoleIs(['admin', 'user'])->get();
        } else {

            $users = User::whereRoleIs(['admin', 'user'])->get();
        }*/

        // This Is Work But Cannot Prevent Show Super Admins Users From Show When Search For Them
        /*
        $users = User::whereRoleIs(['admin', 'user'])->when($request->search, function ($q) use ($request) {

               return $q->where('name', 'like', '%' . $request->search  . '%')
                   ->orwhere('email', 'like', '%'. $request->search . '%');

        })->latest()->paginate(5);*/

        // Edit The Last Commented Work To Prevent Show Super Admins Users From Show When Search For Them
        $users = User::whereRoleIs(['admin', 'user'])->where(function ($q) use($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('name', 'like', '%' . $request->search  . '%')
                    ->orwhere('email', 'like', '%'. $request->search . '%');

            });
        })->latest()->paginate(5);
        return view('dashboard.users.index', compact('users'));
    } //End of Index




    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    } //End of Create




    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'image' => 'image',
            //'password' => 'required|confirmed|min:8',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required|min:1',
        ]); // End of Validation

        $request_data = $request->except(['password', 'password_confirmation', 'role', 'image']);

        // Prepare The Request Password
        $request_data['password'] = bcrypt($request->password);

        //dd($request_data);
        //dd($request->role);

        // Prepare The Request Image Size & Save It
        if ($request->image) {
            Image::make($request->image)->resize(null, 226, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users_img/' . $request->image->hashName()), 80, 'jpg');
            $request_data['image'] = $request->image->hashName();
        } // End of IF


        $user = User::create($request_data);

        $user->attachRole($request->role);

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('users.index');

    }// End of Store



/*
    public function show(User $user)
    {
        //
    }*/





    public function edit($id)
    {
        //dd($id);
        $user = User::find($id);
        //dd($user);
        $roles = Role::all();
        //dd($user->roles);
        return view('dashboard.users.edit', compact('user', 'roles'));
    }// End of Edit




    public function update(Request $request, $id)
    {
        //dd($request);
        //dd($id);
        $user =User::find($id);
        //dd($user);

        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'image' => 'image',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|min:1',
        ]); // End of Validation

        $request_data = $request->except(['password', 'password_confirmation', 'role', 'image']);
        $request_data['password'] = bcrypt($request->password);
        //dd($request_data);
        //dd($request->role);

        // Prepare The Request Image Size & Save It
        if ($request->image) {

            if ($user->image != 'default.png') { // To Delete The Old User Image
                File::delete(public_path('uploads/users_img/') . $user->image);

            } // End of Inner IF

            // To Save The New User Image (Update It)
            Image::make($request->image)->resize(null, 226, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users_img/' . $request->image->hashName()), 80, 'jpg');

            $request_data['image'] = $request->image->hashName();

        } // End of Outer IF


        $user->update($request_data);

        $user->syncRoles([$request->role]);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('users.index');

    } // End of Update





    public function destroy( $id)
    {
        //dd($id);
        $user =User::find($id);

        // Delete The User Image
        //dd(public_path('uploads/users_img/'));
        if ($user->image != 'default.png') {
            File::delete(public_path('uploads/users_img/') . $user->image);
        }

        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('users.index');
    }  // End of Destroy



} //End of Controller
