<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->get();

        return view('products.index', compact('products'));
    }

    public function getToken()
    {

        $clientId = '83f37845-4f08-42f7-ba59-4600a00747b7';
        $clientSecret = 'Iqr8Q~IkVzXRU5s82YyQEnwnwJXty_0VFG0abcbL';
        $biUsername = 'ali@powerbialioutlook.onmicrosoft.com';
        $biPassword = 'Cusu7050';

        $payload = array(
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'grant_type' => 'password',
            // 'grant_type' => 'password',
            'resource' => 'https://analysis.windows.net/powerbi/api',
            'username' => $biUsername,
            'password' => $biPassword,
        );

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://login.windows.net/common/oauth2/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($payload),
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Host: login.windows.net',
                'Cache-Control: no-cache',
                // 'Content-Type: application/json',
                'Content-Type: application/x-www-form-urlencoded',

            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $loginToken = json_decode($response)->access_token;

            return view('products.powerbi', compact('loginToken'));
        };
    }

    public function curlGetExample()
    {
        $payload = array(
            "accessLevel" => "View",
            "allowSaveAs" => "true"
        );

        $groupId = '94317fc3-c18f-47e0-9106-edb17e56b307';
        $reportId = '2aefd47b-2906-4927-9da6-db2af5716243';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.powerbi.com/v1.0/myorg/groups/${groupId}/reports/${reportId}/GenerateToken
        ");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            http_build_query($payload)
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $serveResponse = curl_exec($ch);
        curl_close($ch);
        return response(compact('serveResponse'));
        // return json_decode($response, true);

        // if ($response == "OK") {
        //     echo 'okay';
        // } else {
        //     echo 'not';
        // }
    }


    public function getDataset()
    {
        $datasetId = 'ea105919-1f48-4326-889e-f6304b555082';
        $payload = array(
            'datasetId' => $datasetId,
        );

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.powerbi.com/v1.0/myorg/datasets/${datasetId}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => http_build_query($payload),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->loginToken,
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // echo "here is your microsoft azure token";
            // print_r(json_decode($response));
            $this->loginToken = json_decode($response)->access_token;
            print_r($this->loginToken);
        }
    }
}
