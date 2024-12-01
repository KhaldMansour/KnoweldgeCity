<?php

namespace App\Http\Controllers;

use App\Http\Controller;

class HomeController extends Controller
{
    public function index($id)
    {
        $data = [
            'id'      => $id,
            'message' => "User ID received"
        ];

        return $this->jsonResponse($data);
    }
}
