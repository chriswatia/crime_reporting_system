<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Twilio\Rest\Client;
use Illuminate\Http\Request;

class SendSmsController extends Controller
{
    public function send(Request $request)
    {
        $sid = app('config')->get('services.twilio.sid');
        $token = app('config')->get('services.twilio.token');
        $phone = app('config')->get('services.twilio.phone');

        // Get the phone number from the request
        $phone_number = $request->input('phone_number');

        // Get the message from the request
        $message = $request->input('message');

        
        $client = new Client($sid, $token);

        // Send the SMS
        $client->messages
                  ->create($phone_number, // to
                           [
                               "body" => $message,
                               "from" => $phone
                           ]
                  );

        // Return a success response
        return response()->json([
            'success' => true
        ]);
    }

    public function saveCountry(Request $request){
        
        $data = $request->all();
        foreach ($data as $obj) {
            $Country = new Country;
            $Country->country_code = $obj['country_code'];
            $Country->country_name = $obj['country_name'];
            $Country->iso_code = $obj['iso_code'];
            $Country->save();
        }        

        return response()->json([
            'success' => true
        ]);
    }
}
