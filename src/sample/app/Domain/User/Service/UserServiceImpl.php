<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepositoryImpl as UserRepository;

class UserServiceImpl implements UserService{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;        
    }

    public function getUserProgressData(){

        $datas = $this->userRepository->getUserProgressData();

        // toArray()でCollectionを配列に変換する
        $infos = $datas->groupBy('name')->toArray();

        $result = array();

        foreach($infos as $key =>$info){

            $count = array_reduce($info, function($arr, $item) {
                $arr += $item->done;
                return $arr;
            });

            // $array = array(
            //     'category' => $key,
            //     'percent' => floor( ($count / count($info)) * 100),
            //     'allCount' => count($info),
            //     'doneCount' => $count,
            // );
            // array_push($result,$array);

            $result += array($key => intval( $count / count($info) * 100));
        }

        // dd($result);
        return $result;


    }

}