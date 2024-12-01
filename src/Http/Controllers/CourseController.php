<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Http\Services\CoursesService;

class CourseController extends Controller
{
    public function __construct(private readonly CoursesService  $coursesService)
    {
    }

    public function index()
    {
        $categories = $this->coursesService->find();

        return $this->jsonResponse($categories);
    }

    public function show($id)
    {
        $category = $this->coursesService->findOne($id);

        return $this->jsonResponse($category);
    }
}
