<?php

namespace App\Http\Controllers;

use App\Models\Crime;
use Illuminate\Http\Request;
use App\Http\Requests\CrimeRequest;
use Illuminate\Support\Facades\Auth;

class CrimeController extends Controller
{
    public function index(){
        if(Auth::user()->role_id == 1){
            $crimes = Crime::all();
        }else{
            $crimes = Crime::where('created_by', Auth::user()->id)->get();
        }
        
        return view('user.crime.index', compact('crimes'));
    }


    public function create(){
        return view('user.crime.create');
    }

    public function store(CrimeRequest $request)
    {
        $data = $request->validated();

        $crime = new Crime;
        $data['created_by'] = Auth::user()->id;
        $data['device_type'] = $request->header('User-Agent');
        $data['mac_address'] = exec('getmac');
        $data['status'] = 'Submitted';
        $crime->create($data);

        return redirect('/crimes')->with('message', "Crime reported successfully");
    }

    public function edit($id){
        $crime = Crime::findOrFail($id);
        return view('user.crime.edit', compact('crime'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $crime = Crime::findOrFail($id);
        $crime->update($data);

        return redirect('/crimes')->with('message', "Crime updated successfully");
    }

    public function destroy($id)
    {
        $crime = Crime::findOrFail($id);
        $crime->delete();

        return redirect('/crimes')->with('message', "Crime deleted successfully");
    }
}