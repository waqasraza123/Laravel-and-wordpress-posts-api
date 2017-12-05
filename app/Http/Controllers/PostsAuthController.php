<?php
namespace App\Http\Controllers;
use GuzzleHttp\Client;
class PostsAuthController extends Controller
{
    //class variables
    private $sessionId;

    /**
     * login to the WordPress site
     * so we can later publish the post
     */
    public function login($username, $password, $url){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/api/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"username\"\r\n\r\n$username\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\n$password\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response, true);
            //the username or password was incorrect
            //dd(count($json['result']) > 0);
            $this->sessionId = ($json['result'][0]['session_id']);
        }
        return $this->sessionId;
    }
}