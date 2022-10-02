<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use Exception;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\RowResult;
use Symfony\Component\HttpFoundation\Response;

class qkyokuTestController extends Controller
{
    // サンプル
    public function sample ()
    {
        $test = 'this is test.';

        $arr = [
            ['no' => 1, 'album_id' => 1, 'title' => '', 'comment' => ''],
            ['no' => 2, 'album_id' => 1, 'title' => '', 'comment' => ''],
            ['no' => 3, 'album_id' => 1, 'title' => '', 'comment' => ''],
            ['no' => 4, 'album_id' => 1, 'title' => '', 'comment' => ''],
            ['no' => 5, 'album_id' => 1, 'title' => '', 'comment' => ''],
            ['no' => 6, 'album_id' => 1, 'title' => '', 'comment' => ''],
            ['no' => 7, 'album_id' => 1, 'title' => '', 'comment' => ''],
            ['no' => 8, 'album_id' => 1, 'title' => '', 'comment' => ''],
            ['no' => 9, 'album_id' => 1, 'title' => '', 'comment' => ''],
        ];

        // 取得した情報をvueのpropsに渡す
        return Inertia::render('Qkyoku/Index',[
            'test' => $test,
            'arr'  => $arr,
        ]);
    }

    public function index ()
    {
        $test = 'this is index.';

        // 取得した情報をvueのpropsに渡す
        return Inertia::render('Qkyoku/Index',[
            'test' => $test,
        ]);
    }



    // public function search (Request $request)
    public function search ($type, $queryWord)
    // public function search ()
    {
        $token = $this->getToken();

        $t = $type;
        $q = $queryWord;

        // dump($t);
        // dump($q);
        // exit;

        // $type = 'album';
        // $type = 'artist';
        $type_change = [
            'artist' => 'artists',
            'album'  => 'albums',
        ];

        $data = $this->executeApi($token['access_token'], $q, $t);

        // dump($data[$type_change[$type]]['items']);
        // $data = $this->searchArtistAlbums($token['access_token']);

        // dump($data);
        // exit;

        // dump($data);
        // exit;


        // dump($data);
        // dump($data['albums']['items']);
        // exit;

        // $result = $this->getTest($queryWord);
        // $result = '{ "message": null, "results": [ { "address1": "埼玉県", "address2": "さいたま市見沼区", "address3": "東大宮", "kana1": "ｻｲﾀﾏｹﾝ", "kana2": "ｻｲﾀﾏｼﾐﾇﾏｸ", "kana3": "ﾋｶﾞｼｵｵﾐﾔ", "prefcode": "11", "zipcode": "3370051" } ], "status": 200 }';
        // $result = json_decode($result, true);
        // $items = $result['results'][0] ?? [];
        // $result = $result['results'][0]['prefcode'] ?? '';

        // dump($t == 'album');

        // 取得した情報をvueのpropsに渡す
        return Inertia::render('Qkyoku/Search',[
            // 'test'       => $token['access_token'],
            'test'       => $t,
            'items'      => $data[$type_change[$t]]['items'],
            // 'type'       => $t,
        ]);

    }

    // 選択
    public function select ($id)
    {
        $token = $this->getToken();
        $q = $id;
        $t = 'album';

        $data = $this->searchArtistAlbums($token['access_token'], $q);

        // dump($t);


        // 取得した情報をvueのpropsに渡す
        return Inertia::render('Qkyoku/Search',[
            'test' => $t,
            'items' => $data['items'],
        ]);

    }

    // 詳細(未実装)
    public function detail ($id)
    {
        $token = $this->getToken();
        $q = $id;
        $t = 'album';

        $data = $this->searchArtistAlbums($token['access_token'], $q);

        dump($data);
        exit;

        // 取得した情報をvueのpropsに渡す
        return Inertia::render('Qkyoku/Search',[
            'test' => $t,
            'items' => $data['items'],
        ]);

    }

    // 確定
    public function decide (Request $request)
    {
        // dump($request->id);
        $token = $this->getToken();
        $id = $request->id;
        $data = $this->getAlbumData($token['access_token'], $id);

        // // 取得した情報をvueのpropsに渡す
        return Inertia::render('Qkyoku/Input',[
            'items' => $data,
        ]);
    }

    /**
     * getテスト
     * @return string
     */
    private static function getTest($num)
    {
        //MCクライアント関連情報設定
        $url = "https://zipcloud.ibsnet.co.jp/api/search";

        $data = [
            'zipcode' => $num,
        ];
        $response = Http::get($url, $data);

        // // 外部連携APIを叩く
        // $client = new Client();
        // try {


        //     $response = $client->request('GET', $url, $requests);

        //     // ステータスコード200番台以外はエラー
        //     if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
        //         throw new Exception($response->getReasonPhrase());
        //     }
        //     // 成功時、レスポンスを取得しトークンの有効期間を更新
        // $response_data = json_decode($response->getBody()->getContents(), true);
        $response_data = $response->getBody()->getContents();

        // // エラー時
        // } catch (Exception $e) {
        //     $response_data = null;
        // }
        return $response_data;
    }


        /**
     * アクセストークン発行
     * @return string
     */
    private static function getToken()
    {
        //MCクライアント関連情報設定
         $url = 'https://accounts.spotify.com/api/token';
         $client_id = '9083d81372c545c9b02b769e9ac8e2db';
         $secret_key = '7122b024cbbb4083a3ea5bbfe241df67';
         $base64encoded = 'OTA4M2Q4MTM3MmM1NDVjOWIwMmI3NjllOWFjOGUyZGI6NzEyMmIwMjRjYmJiNDA4M2EzZWE1YmJmZTI0MWRmNjc=';

        //　リクエスト情報
        $requests = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'auth' => [
                $client_id,
                $secret_key
            ],
            'form_params' => [
                "grant_type"    =>  "client_credentials",
            ],
            // // 4xx, 5xx エラー時、例外を投げない
            // 'http_errors' => false,
        ];

        // $requests = [];

        // 外部連携APIを叩く
        $client = new Client();
        // try {
            $response = $client->request('POST', $url, $requests);

            // dump($response);

// ^ array:3 [▼
//   "access_token" => "BQCvgG1NNYG1MhJvAvGebB7oJWrQ0zJYWKh1ScksNITrgGPwtg3a3_v-w_gBUP6XT34tpHFpeUf6FoOcuVqxeHHYYRD5md8KDOL4gPt20GsZfsnpHSU"
//   "token_type" => "Bearer"
//   "expires_in" => 3600
// ]

            // ステータスコード200番台以外はエラー
            // if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            //     throw new Exception($response->getReasonPhrase());
            // }
            // 成功時、レスポンスを取得しトークンの有効期間を更新
            $response_data = json_decode($response->getBody()->getContents(), true);
            // $token = $response_data[$key_name] ?? null;
            // todo: 期限を確認して設定値変える
            // Cache::put($key_name, $response_data[$key_name], config('mc_config.MC_ACCESS_TOKEN_TTL'));
        // エラー時
        // } catch (Exception $e) {
        //     $token = null;
        // }
        return $response_data;
        // return $token;
    }

    private static function executeApi($token, $q, $type = 'artist')
    {
        // エンドポイント
        $url = 'https://api.spotify.com/v1/search';

        $requests = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
            'query' => [
                'q'    => $q,
                'type' => $type,
                'limit'=> 10,
            ],
        ];

        $method = 'GET';

        // 外部連携APIを叩く (エラー時、指定秒数待機、指定回数リトライ)
        $client = new Client;

        $response = $client->request($method, $url, $requests);

        // 成功時、レスポンスを取得(※現状は、session_idから登録したuidを返している)
        $response_data = json_decode($response->getBody()->getContents(), true);
        // dump($response_data);
        // exit;

        return $response_data;
    }


    // $q = artist_id
    private static function searchArtistAlbums($token, $q)
    {
        // エンドポイント
        // $url = 'https://api.spotify.com/v1/artists/1O8CSXsPwEqxcoBE360PPO';
        // $artist_id = '5kjGRHClVacSyllOUqU1S0';
        $artist_id = $q;
        $url = "https://api.spotify.com/v1/artists/{$artist_id}/albums";

        $requests = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
            'query' => [
                'limit' => 50,
            ],
        ];

        $method = 'GET';

        // 外部連携APIを叩く (エラー時、指定秒数待機、指定回数リトライ)
        $client = new Client;

        $response = $client->request($method, $url, $requests);



        // // ステータスコード200番台以外はエラー
        // if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
        //     throw new Exception($response->getReasonPhrase());
        // }
        // 成功時、レスポンスを取得(※現状は、session_idから登録したuidを返している)
        $response_data = json_decode($response->getBody()->getContents(), true);

        return $response_data;
    }


    private static function getAlbumData($token, $id)
    {
        $album_id = $id;

        $url = "https://api.spotify.com/v1/albums/{$album_id}";

        $requests = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
            // 'query' => [
            // ],
        ];

        $method = 'GET';

        // 外部連携APIを叩く (エラー時、指定秒数待機、指定回数リトライ)
        $client = new Client;
        $response = $client->request($method, $url, $requests);

        // // ステータスコード200番台以外はエラー
        // if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
        //     throw new Exception($response->getReasonPhrase());
        // }
        // 成功時、レスポンスを取得(※現状は、session_idから登録したuidを返している)
        $response_data = json_decode($response->getBody()->getContents(), true);
        return $response_data;
    }



    // Intervation処理イメージ
    public static function process_images()
    {
        // TODO:: Intervation/images必須
        // constで配置するタイルの列を決める(行、列、正方形のサイズ)
        $tile_props = [
            'row' => 3,
            'col' => 3,
            'size_px' => 100,
        ];
        $image_paths = [];

        //デフォルト画像（白地）の呼び出し
        // 全体サイズの計算 row * size_px , col * size_px
        $default_x = $tile_props['row'] * $tile_props['size_px'];
        $default_y = $tile_props['col'] * $tile_props['size_px'];
        $default = Image::canvas($default_x, $default_y, '#ffffff');

        // 画像インスタンスを配列で読む
        foreach ($images_paths as $image_path) {
            $my_images['連数'] = Image::make(storage_path($image_path));
            $x = 0;
            $y = 0;

            // tile_props['row'] > ループ回数
            // 横にsize_px分ずらす
            $x += $tile_props['size_px'];

            // tile_props['row'] < ループ回数
            // 改行(0地点に戻り、縦にsize_px分ずらす)
            $x = 0;
            $y += $tile_props['size_px'];

            $default->insert($my_images['連数'], 'top-left', $x, $y);

            // ■■■
            // ■■■
            // ■■■
            // 上記のようになる
        }

        // db保存処理

        // 簡単にアクセスできないファイル名にする(uuid)


        //保存先のパスを定義
        $save_path = storage_path("app/public/sample/{id}.png");


        // s3へ保存




    }

    public function test(Request $request){
        dump($request->all());
        dump('test');
        exit;
    }





}
