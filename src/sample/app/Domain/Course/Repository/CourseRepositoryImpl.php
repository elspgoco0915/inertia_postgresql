<?php

namespace App\Domain\Course\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CourseRepositoryImpl implements CourseRepository{

    public function getCourseByCategroy($categroy){

        // $result = DB::table('categories')
        //     // ->select('courses.title', 'courses.file' , 'progress.done')
        //     ->select('courses.id','courses.title', 'courses.file' , 'progress.done')
        //     ->leftJoin('courses', 'categories.id', '=', 'courses.category_id')
        //     ->leftJoin('progress', 'courses.id' , '=' , 'progress.course_id')
        //     ->where('progress.user_id', '=', '1') //ここはAuthから取得するようにする
        //     ->where('categories.name' , '=' , $categroy)
        //     ->get();

        $result = DB::table('courses')
            ->select('courses.id','courses.title', 'courses.file')
            ->selectRaw("CASE WHEN progress.done IS NULL THEN false ELSE progress.done END AS done")
            ->leftJoin('progress', function($join){
                $join->on('courses.id' , '=', 'progress.course_id');
                $join->where('progress.user_id', '=', Auth::id());
            })->where('courses.category_id', '=', function($query) use($categroy){
                $query->selectRaw('id')->from('categories')->where('name', '=', $categroy);
            })->get();


        return $result;

        // return "リポジトリから取得しました";
    }

    public function getCourseDetail($id){
        
        // $result = DB::table('courses')
        //     ->select('courses.id','courses.title', 'courses.file' , 'progress.done', 'categories.name')
        //     ->leftJoin('categories', 'categories.id', '=', 'courses.category_id')
        //     ->leftJoin('progress', 'courses.id' , '=' , 'progress.course_id')
        //     ->where('courses.id', '=', $id)
        //     ->where('progress.user_id' , '=', '1')
        //     ->get()
        //     ->first();

        $result = DB::table('courses')
            ->select('courses.id','categories.name','courses.title', 'courses.file')
            // ->selectRaw("case when progress.done IS NULL then 0 else progress.done END AS done")
            ->selectRaw("CASE WHEN progress.done IS NULL THEN false ELSE progress.done END AS done")
            ->leftJoin('progress', function($join){
                $join->on('courses.id', '=' ,'progress.course_id');
                $join->where('progress.user_id' , '=', Auth::id());
            })->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
            ->where('courses.id', '=', $id)
            ->get()
            ->first();

        return $result;
    }


}