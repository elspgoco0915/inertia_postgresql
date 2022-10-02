<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

// use App\Providers\CourseServiceProvider;
use App\Domain\User\Service\UserServiceImpl as UserService;
use App\Domain\Course\Service\CourseServiceImpl as CourseService;
use Illuminate\Support\Facades\Auth;



class CourseUserController extends Controller
{
    private UserService $userSerivce;

    public function __construct(UserService $userSerivce)
    {
        $this->userSerivce = $userSerivce;
    }

    //
    public function dashbord()
    {
        $info = $this->userSerivce->getUserProgressData();

        // ユーザー情報の取得(モック)
        // $info = [
        //     'user_name' => 'misaka',
        //     'stage'     => '一般アカウント',
        //     'done'      => false,
        //     'scores'    => [
        //         'level1' => 80, 
        //         'level2' => 81, 
        //         'level3' => 90, 
        //         'level4' => 100, 
        //         'level5' => 0
        //     ],
        // ];

        $done = empty(preg_grep("/^\d{1,2}$/",$info)) ? true : false ;

        // 取得したユーザー情報をvueにpropsに渡す
        return Inertia::render('Mypage/Dashbord', [
            'info'      => $info,
            'done'      => $done,
            'user_name' => Auth::user()->name,
        ]);
    }
}
