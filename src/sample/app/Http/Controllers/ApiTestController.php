<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ApiTestController extends Controller
{

    // http://localhost/api/test
    public function index(Request $request) {


        $requests = $request->all();

        // $client = new Client();
        // // $method = 'POST';
        // $method = 'GET';
        // $url = 'https://dog.ceo/api/breeds/image/random';
        // $requests = [];
        // $response = $client->request('GET', $url, $requests);

        $response = Http::get('https://zipcloud.ibsnet.co.jp/api/search', [
            'zipcode' => $requests['query'],
        ]);
        

        // 成功時、レスポンスを取得しトークンの有効期間を更新
        $response_data = json_decode($response->getBody()->getContents(), true);
        return $response_data;
        // return [
        //     'tes'   => 'test'
        // ];
    }

}
