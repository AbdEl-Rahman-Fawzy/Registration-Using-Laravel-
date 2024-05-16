<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class BirthdayController extends Controller{
    public function showForm(){
        return view('birthday');
    }

    public function GetCelebrities(Request $request)
    {
            $day = $request->input('day');
            $month = $request->input('month');
    
            $curl = curl_init();
    
            $url = "https://imdb188.p.rapidapi.com/api/v1/getBornOn?month=" . $month . "&day=" . $day;
    
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: imdb188.p.rapidapi.com",
                    "X-RapidAPI-Key: 931a2ca2a2msh50c012241a6c4d9p11e8b2jsn771fb64bdfe0"
                ],
            ]);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
            $response = curl_exec($curl);
            $err = curl_error($curl);
    
            curl_close($curl);
    
            if ($err) {
                return response()->json(['error' => 'cURL Error #' . $err], 500);
            } else {
                
                $responseData = json_decode($response, true);
                
                return response()->json($responseData);
            }
        
    }
    
}