<?php

namespace App\Http\Controllers;

// use App\Domain\Course\Service\CourseService;
use App\Domain\Course\Service\CourseServiceImpl as CourseService;
// use App\Domain\Course\Service\CourseServiceImpl;

use Illuminate\Http\Request;
use Inertia\Inertia;
use File;
use Illuminate\Mail\Markdown;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    private CourseService $couseService;

    //
    public function __construct(CourseService $couseService)
    {
        $this->couseService = $couseService;
    }

    //
    public function index($category)
    {
        $info = $this->couseService->getCourseByCategroy($category);
        // dd($result);

        // $data1 = [
        //     'title' => "インシデント発生時の報告方法について",
        //     'file' => "sample.md",
        //     'done' => false,
        // ];

        // $data2 = [
        //     'title' => "入館証の取り扱いについて",
        //     'file' => "security.md",
        //     'done' => true,
        // ];

        // $courses = [];
        // array_push($courses, $data1, $data2);

        // $info = [
        //     'category' => "level1",
        //     'courses' => $courses,
        // ];

        // 取得した情報をvueのpropsに渡す
        return Inertia::render('Mypage/CourseIndex',[
            'info' => $info,
        ]);
    }

    //
    public function detail($id)
    // public function detail($category, $detail)
    {
        // dump($id);
        // exit;

        // // パス
        // $path = resource_path('markdown' . '/' . $category);

        // try{
        //     $file = File::get($path . '/' . $detail);
        // } catch(Exception $e) {
        //     dd("エラーです");
        // };

        // $detail = Markdown::parse($file);

        // dump($detail->toHtml());
        // exit;

        $detail = $this->couseService->getCourseDetail($id);

        return Inertia::render('Mypage/CourseDetail',[
            'info'   => $detail['info'],
            'detail' => $detail['html'],
        ]);

    }

    public function done (Request $request)
    {
        $progress = Progress::updateOrCreate(
            ['user_id' => Auth::id(), 'course_id' => $request->course_id],
            // ['user_id' => '1', 'course_id' => $request->course_id],
            ['done' => true]
        );

        return back();
    }


}
