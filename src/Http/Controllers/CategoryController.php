<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Http\Services\CategoriesService;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoriesService  $categoriesService)
    {
    }

    public function index()
    {
        $categories = $this->categoriesService->find();

        return $this->jsonResponse($categories);
    }

    public function show($id)
    {
        $category = $this->categoriesService->findOne($id);

        return $this->jsonResponse($category);
    }
}
