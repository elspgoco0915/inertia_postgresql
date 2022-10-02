<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    //
    public function index ()
    {
        $test = 'this is test.';

        return Inertia::render('Testpage/Index',[
            'test' => $test,
        ]);

        // // 取得した情報をvueのpropsに渡す
        // return Inertia::render('Testpage/Index',[
        //     'info' => $info,
        // ]);
    }

    public function form_test ()
    {
        $test = 'hoge';

        return Inertia::render('Testpage/Form',[
            'test' => $test,
        ]);
    }

    public function form ()
    {



    }




}
