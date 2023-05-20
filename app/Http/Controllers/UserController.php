<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //USER LIST
    public function index(){
        $user_list = User::all();
        return view('auth.users.index', compact('user_list'));
    }

    public function create(){
        $roles = Role::all();
        return view('auth.users.create', compact('roles'));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::all();
        $countries = Country::all();
        return view('auth.users.edit', compact('user','roles', 'countries'));
    }

    public function editProfile($id){
        $user = User::findOrFail($id);
        $roles = Role::all();
        $countries = Country::all();
        return view('auth.users.profile.edit', compact('user','roles', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $user = User::findOrFail($id);
        $country_code = $data['country_code'];
        $phoneNumber = $data['phone'];

        if (Str::startsWith($phoneNumber, '07')) {
            $phoneNumber = Str::replaceFirst('0', '', $phoneNumber);
        }

        $data['phone'] = $phoneNumber;

        $user->update($data);
        if(Auth::user()->role_id == 1){
            return redirect('admin/users')->with('message', "User updated successfully");
        }
        else{
            return redirect('/admin')->with('message', "User updated successfully");
        }
        
    }

    public function updateProfile(Request $request, $id)
    {
        $data = $request->all();

        $user = User::findOrFail($id);
        $country_code = $data['country_code'];
        $phoneNumber = $data['phone'];

        if (Str::startsWith($phoneNumber, '07')) {
            $phoneNumber = Str::replaceFirst('0', '', $phoneNumber);
        }

        $data['phone'] = $phoneNumber;
        $user->update($data);

        return redirect('/')->with('message', "User updated successfully");
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('admin/users')->with('message', "User deleted successfully");
    }
}
