<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Route;
use App\Http\Services\CategoriesService;
use App\Http\Services\CoursesService;

$categoriesService = new CategoriesService();
$coursesService    = new CoursesService();

Route::get('/categories', function () use ($categoriesService) {
    $controller = new CategoryController($categoriesService);
    return $controller->index();
});

Route::get('/categories/{id}', function ($id) use ($categoriesService) {
    $controller = new CategoryController($categoriesService);
    return $controller->show($id);
});

Route::get('/courses', function () use ($coursesService) {
    $controller = new CourseController($coursesService);
    return $controller->index();
});

Route::get('/courses/{id}', function ($id) use ($coursesService) {
    $controller = new CourseController($coursesService);
    return $controller->show($id);
});
