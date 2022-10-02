<?php

namespace App\Domain\User\Repository;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserRepositoryImpl implements UserRepository{

    public function getUserProgressData() : Collection{

        $result = DB::table('courses')
                    ->select('courses.id','categories.name','courses.category_id','courses.title', 'courses.file')
                    ->selectRaw("case when progress.done IS NULL then false else progress.done END AS done")
                    ->leftJoin('progress', function($join){
                        $join->on('courses.id' , '=', 'progress.course_id');
                        $join->where('progress.user_id', '=', Auth::id());
                    })
                    ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
                    ->get();

        return $result;
    }

}