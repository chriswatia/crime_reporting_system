<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\InvestigatingOfficer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InvestigatingOfficerRequest;

class InvestigatingOfficerController extends Controller
{
    public function index(){
        $investigating_officers = DB::table('users as u')->leftJoin('investigating_officers as invo', 'invo.user_id', 'u.id')
        ->leftJoin('crime_categories as cc', 'invo.category_id', 'cc.id')
        ->select('invo.id as invo_id', 'u.id as u_id', 'invo.*', 'u.*','cc.*')
        ->where('u.role_id', 3)
        ->get();
        return view('admin.investigating_officer.index', compact('investigating_officers'));
    }


    public function create(){
        return view('admin.investigating_officer.create');
    }

    public function store(InvestigatingOfficerRequest $request)
    {
        $data = $request->validated();

        $investigating_officer = new InvestigatingOfficer;
        $data['created_by'] = Auth::user()->id;
        $investigating_officer->create($data);

        return redirect('admin/investigating_officers')->with('message', "Investigating Officer created successfully");
    }

    public function edit($id){
        $investigating_officer = User::leftJoin('investigating_officers as invo', 'invo.user_id', 'users.id')
        ->select('invo.id as invo_id', 'users.id as u_id', 'invo.*', 'users.*')
        ->where('users.id', $id)->first();
        return view('admin.investigating_officer.edit', compact('investigating_officer'));
    }

    public function update(Request $request, $id)
    {
        if($request->invo_id){
            $data = $request->all();
            $investigating_officer = InvestigatingOfficer::findOrFail($request->invo_id);
            $investigating_officer->update($data);
        }
        else{
            $data = $request->all();
            $investigating_officer = new InvestigatingOfficer;
            $data['user_id'] = $request->user_id;
            $data['created_by'] = Auth::user()->id;
            $investigating_officer->create($data);
        }        

        return redirect('admin/investigating_officers')->with('message', "Investigating Officer updated successfully");
    }

    public function destroy($id)
    {
        $investigating_officer = User::leftJoin('investigating_officers as invo', 'invo.user_id', 'users.id')
        ->select('invo.id as invo_id', 'users.id as u_id', 'invo.*', 'users.*')
        ->where('users.id', $id)->first();

        $investigating_officer = InvestigatingOfficer::findOrFail($investigating_officer);
        $investigating_officer->delete();

        return redirect('admin/investigating_officers')->with('message', "Investigating Officer deleted successfully");
    }
}
