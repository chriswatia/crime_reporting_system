<?php

namespace App\Http\Controllers;

use App\Models\Crime;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Requests\CrimeRequest;
use App\Mail\CrimeNotificationMail;
use Illuminate\Support\Facades\Auth;

class CrimeController extends Controller
{
    public function index(){
        $crimes = Crime::where('created_by', Auth::user()->id)->get();        
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
        if(!isset($data->mac_address)){
            $data['mac_address'] = \Request::ip();
        }
        $data['status'] = 'Submitted';
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads'), $filename);
            $data['file'] = $filename;
        }

        $crimes_index = Crime::max('id') + 1;
        $crime_no = "CRM-".$crimes_index;
        $data['crime_no'] = $crime_no;
        
        $crime->create($data);

        $user = Auth::user();

        //Send SMS
        $sid = app('config')->get('services.twilio.sid');
        $token = app('config')->get('services.twilio.token');
        $phone = app('config')->get('services.twilio.phone');

        $phone_number = $user->country_code.''.$user->phone;
        $name = $user->firstname;
        $message = "Hello ".$name.", crime Ref - ".$crime_no." was reported successfully!";

        $body = "Your crime Ref - ".$crime_no." was reported successfully!";
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
