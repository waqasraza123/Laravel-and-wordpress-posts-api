<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;

class PostsHandlerController extends Controller
{

    /**
     * create the post after login
     *
     * @param $sessionId
     * @param $subject
     * @param $content
     * @param $imageId
     * @param $tags
     * @param $publishDate
     * @param $postStatus
     * @param $siteUrl
     */
    public function createPost($sessionId, $subject, $content, $imageId, $publishDate, $postStatus, $tags, $siteUrl){
        $curl = curl_init();
        $params = array(
            'subject' => $subject,
            'SESSION_ID' => $sessionId,
            'content' => $content,
            'thumbnail_id' => $imageId,
            'post_status' => $postStatus,
            'post_date' => $publishDate,
            'tags' => $tags
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$siteUrl/api/newpost/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $params,
        ));
        /*curl_setopt_array($curl, array(
            CURLOPT_URL => "$siteUrl/api/newpost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"subject\"\r\n\r\n$subject\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"content\"\r\n\r\n$content\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"post_status\"\r\n\r\n$postStatus\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"post_date\"\r\n\r\n$publishDate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"SESSION_ID\"\r\n\r\n$sessionId\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"thumbnail_id\"\r\n\r\n$imageId\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--"

        ));*/
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function uploadImage($sessionId, $imageUrl, $siteUrl){
        $curl = curl_init();
        $params = array(
            'file' => new \CurlFile(public_path($imageUrl)),
            'SESSION_ID' => $sessionId
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$siteUrl/api/upload_media/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $params,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response, true);
            return $json['result']['media_id'];
        }
    }
}
