<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Crime;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Models\CrimeProgress;
use App\Exports\AllCrimeExport;
use App\Models\CrimeAssignment;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CrimeRequest;
use App\Mail\CrimeNotificationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UnassignedCrimeExport;
use App\Exports\CrimeUnderInvestigationExport;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function reportedCrimes(){
        $crimes = Crime::all();        
        return view('admin.crime.index', compact('crimes'));
    }

    public function create(){
        return view('admin.crime.create');
    }

    public function store(CrimeRequest $request)
    {
        $data = $request->validated();

        $crime = new Crime;
        $data['created_by'] = Auth::user()->id;
        $data['device_type'] = $request->header('User-Agent');
        $data['mac_address'] = exec('getmac');
        if(!isset($data->mac_address)){
            $data['mac_address'] = \Request::ip();
        }
        $data['status'] = 'Submitted';
        $crime->create($data);

        return redirect('admin/crimes')->with('message', "Crime reported successfully");
    }

    public function edit($id){
        $crime = Crime::findOrFail($id);
        return view('admin.crime.edit', compact('crime'));
    }

    public function viewCrime($id){
        $crime = Crime::findOrFail($id);
        return view('admin.crime.edit', compact('crime'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $crime = Crime::findOrFail($id);
        $crime->update($data);

        return redirect('admin/crimes')->with('message', "Crime updated successfully");
    }

    public function destroy($id)
    {
        $crime = Crime::findOrFail($id);
        $crime->delete();

        return redirect('admin/crimes')->with('message', "Crime deleted successfully");
    }

    public function crimeAssign($id){
        $crime = Crime::findOrFail($id);
        return view('admin.crime.assign', compact('crime'));
    }

    public function crimeAssigment(Request $request, $id)
    {
        $data = $request->all();
        $crime = Crime::findOrFail($id);
        $data['category_id'] = $crime->category_id;
        $data['status'] = "In Progress";
        $crime->update($data);

        $CrimeAssignment = new CrimeAssignment;
        $CrimeAssignment->officer_id = $request->officer_id;
        $CrimeAssignment->crime_id = $request->crime_id;
        $CrimeAssignment->created_by = Auth::user()->id;
        $CrimeAssignment->save();

        $crime = Crime::find($request->crime_id);

        $user = User::find($crime->created_by);

        $officer = User::find($request->officer_id);

        //Send SMS
        $sid = app('config')->get('services.twilio.sid');
        $token = app('config')->get('services.twilio.token');
        $phone = app('config')->get('services.twilio.phone');

        $phone_number = $user->country_code.''.$user->phone;
        $name = $user->firstname;
        $message = "Hello ".$name.", crime Ref - ".$crime->crime_no." has been assigned an investigating officer : " .$officer->firstname." " .$officer->lastname;
        
        $body = "Your crime Ref - ".$crime->crime_no." has been assigned an investigating officer : " .$officer->firstname." " .$officer->lastname;

        //Send Mail
        \Mail::to($user->email)->send(new CrimeNotificationMail($name, $body));
        
        $client = new Client($sid, $token);

        // Send the SMS
        $res = $client->messages
                  ->create($phone_number, // to
                    [
                        "body" => $message,
                        "from" => $phone
                    ]
                  );

        
        return redirect('admin/crimes')->with('message', "Crime assigned to investigating officer successfully");
    }

    public function unassigned_crimes(){
        $crimes = Crime::where('status', 'Submitted')->get();        
        return view('admin.crime.unassigned_crimes', compact('crimes'));
    }
    public function crimes_under_investigation(){
        $crimes = Crime::where('status', 'In Progress')->get();        
        return view('admin.crime.under_investigation', compact('crimes'));
    }

    public function crimeEvidence($id){
        $crime = Crime::findOrFail($id);
        return view('admin.crime.evidence', compact('crime'));
    }

    public function crimeAddEvidence(Request $request, $id)
    {
        $CrimeProgress = new CrimeProgress;
        $CrimeProgress->description = $request->description;
        $CrimeProgress->crime_id = $request->crime_id;
        $CrimeProgress->created_by = Auth::user()->id;
        
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads'), $filename);
            $CrimeProgress->file = $filename;
        }
        $CrimeProgress->save();

        $crime = Crime::find($request->crime_id);

        $user = User::find($crime->created_by);

        //Send SMS
        $sid = app('config')->get('services.twilio.sid');
        $token = app('config')->get('services.twilio.token');
        $phone = app('config')->get('services.twilio.phone');

        $phone_number = $user->country_code.''.$user->phone;
        $name = $user->firstname;
        $message = "Hello ".$name.", crime Ref - ".$crime->crime_no." has new evidence : " .$request->description;

        $body = "Your crime Ref - ".$crime_no." has new evidence : " .$request->description;
        //Send Mail
        \Mail::to($user->email)->send(new CrimeNotificationMail($name, $body));
        $client = new Client($sid, $token);

        // Send the SMS
        $client->messages
                  ->create($phone_number, // to
                    [
                        "body" => $message,
                        "from" => $phone
                    ]
                  );
                  
        return redirect('admin/crimes')->with('message', "Crime Progress added successfully");
    }

    public function crimeClose($id){
        $crime = Crime::findOrFail($id);
        return view('admin.crime.close', compact('crime'));
    }

    public function closeCrime(Request $request, $id)
    {
        $data = $request->all();
        $crime = Crime::findOrFail($id);
        $crime->status = "Completed";
        $crime->save();

        $CrimeProgress = new CrimeProgress;
        $CrimeProgress->description = $request->description;
        $CrimeProgress->crime_id = $request->crime_id;
        $CrimeProgress->created_by = Auth::user()->id;
        $CrimeProgress->save();

        $crime = Crime::find($request->crime_id);

        $user = User::find($crime->created_by);

        //Send SMS
        $sid = app('config')->get('services.twilio.sid');
        $token = app('config')->get('services.twilio.token');
        $phone = app('config')->get('services.twilio.phone');

        $phone_number = $user->country_code.''.$user->phone;
        $name = $user->firstname;
        $message = "Hello ".$name.", crime Ref - ".$crime->crime_no." was closed due to : ".$request->description;

        $body = "Your crime Ref - ".$crime_no." was closed due to : ".$request->description;

        //Send Mail
        \Mail::to($user->email)->send(new CrimeNotificationMail($name, $body));
        $client = new Client($sid, $token);

        // Send the SMS
        $client->messages
                  ->create($phone_number, // to
                    [
                        "body" => $message,
                        "from" => $phone
                    ]
                  );

        return redirect('admin/crimes')->with('message', "Crime Progress added successfully");
    }

    public function reported_cases(){
        $crimes = Crime::all();        
        return view('admin.crime.cases', compact('crimes'));
    }

    public function reporters(){
        $crimes = DB::table('crimes as c')->join('users as u', 'c.created_by', 'u.id')
        ->join('crime_categories as cc', 'c.category_id', 'cc.id')
        ->selectRaw('GROUP_CONCAT(cc.category_name) as crimes_reported,GROUP_CONCAT(c.description) as description, firstname, lastname')
        ->groupBy('c.created_by','u.firstname','u.lastname')->get();        
        return view('admin.crime.reporters', compact('crimes'));
    }

    public function officers(){
        $investigating_officers = DB::table('users as u')->leftJoin('investigating_officers as invo', 'invo.user_id', 'u.id')
        ->leftJoin('crime_categories as cc', 'invo.category_id', 'cc.id')
        ->select('invo.id as invo_id', 'u.id as u_id', 'invo.*', 'u.*','cc.*')
        ->where('u.role_id', 3)
        ->get();
        return view('admin.crime.investigating_officers', compact('investigating_officers'));
    }

    public function exportCrimes(){
        return Excel::download(new AllCrimeExport, 'allcrimes.xlsx');
    }

    public function exportUnassignedCrimes(){
        return Excel::download(new UnassignedCrimeExport, 'unassigned_crimes.xlsx');
    }

    public function exportcrimes_under_investigation(){
        return Excel::download(new CrimeUnderInvestigationExport, 'crimes_under_investigation.xlsx');
    }
    
}
