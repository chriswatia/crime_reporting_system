<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrimeCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CrimeCategoryRequest;

class CrimeCategoryController extends Controller
{
    public function index(){
        $crime_categories = CrimeCategory::all();
        return view('admin.crime_category.index', compact('crime_categories'));
    }


    public function create(){
        return view('admin.crime_category.create');
    }

    public function store(CrimeCategoryRequest $request)
    {
        $data = $request->validated();

        $crime = new CrimeCategory;
        $data['created_by'] = Auth::user()->id;
        $crime->create($data);

        return redirect('admin/crime_categories')->with('message', "Crime Category created successfully");
    }

    public function edit($id){
        $crime = CrimeCategory::findOrFail($id);
        return view('admin.crime_category.edit', compact('crime'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $crime = CrimeCategory::findOrFail($id);
        $crime->update($data);

        return redirect('admin/crime_categories')->with('message', "Crime Category updated successfully");
    }

    public function destroy($id)
    {
        $crime = CrimeCategory::findOrFail($id);
        $crime->delete();

        return redirect('admin/crime_categories')->with('message', "Crime Category deleted successfully");
    }
}
