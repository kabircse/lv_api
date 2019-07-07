<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OtherSite extends Controller
{
    public function login_oauth_token() {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://127.0.0.1:8000',
        ]);

        $response = $client->post('/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'P469vmpQ1qgkFon0OxNy7ZgsR1P89l7lBQrPoyd2',
                'username' => 'kabir.cse10@gmail.com',
                'password' => 'kabir123'
            ],
        ]);

        $arr_result = json_decode((string) $response->getBody(), true);
        dump($arr_result);
        dd($arr_result['access_token']);
        $token = $arr_result['access_token'];
        session::put('access_token',$token);
        return $token;
    }

    public function login_credentials() {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://127.0.0.1:8000',
        ]);
        $response = $client->post('/api/login', [
            'form_params' => [
                'email' => 'kabir.cse10@gmail.com',
                'password' => 'kabir123'
            ]
        ]);

        $arr_result = json_decode((string) $response->getBody(), true);
        dump($arr_result);
        dd($arr_result['access_token']);
        $token = $arr_result['access_token'];
        session('access_token',$token);
        return $token;
    }

    public function api_products() {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://127.0.0.1:8000',
        ]);
        $token = session('access_token');
        if(!$token){
            $this->login_credentials();
            //or
            //$this->login_oauth_token();
        }
        $response = $client->get('/api/products', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ]
        ]);
        $arr_result = json_decode((string) $response->getBody(), true);
        dump($arr_result);
        dd($arr_result['products']);
    }
}
