<?php

namespace App\Domain\Course\Service;

interface CourseService{

    public function getCourseByCategroy($categroy);
 
    public function getCourseDetail($id);

}