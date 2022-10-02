<?php

namespace App\Domain\Course\Repository;

interface CourseRepository{

    public function getCourseByCategroy($categroy);

    public function getCourseDetail($id);

}