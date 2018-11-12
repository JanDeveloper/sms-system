<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketEntry;

class MessageController extends Controller
{
    public function message(Request $request){
        $message = $request->input('message');
        $phoneNumber = $request->input('phone_number');
        $encodeMessage = urlencode($message);
        $authkey = '';
        $senderId = '';
        $route = 4;
        $postData = $request->all();
        
        $phoNumber = implode('', $postData['phone_number']);
        
        $arr = str_split($phoNumber, '10');
        $phones = implode(", ", $arr);
        //print_r($phones);
        //exit();
        $data = array(
            'authkey' => $authkey,
            'phones' => $phones,
            'mesage' => $encodeMessage,
            'sender' => $senderId,
            'route' => $route,
        );
        
        $url = "";
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data
            //,CURLOPT_FOLLOWLOCATION => true
        ));
        

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //get response
        $output = curl_exec($ch);

        //print error if any
        if(curl_errno($ch)){
            echo 'error:' . curl_error($ch);
        }
        //print_r($data);
        //exit();

        curl_close($ch);
        return redirect('/home')->with('response', 'Message Sent Successfully');
    }
}
