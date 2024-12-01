<?php

namespace App\Http;

class Controller
{
    protected function jsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        http_response_code(200);

        exit;
    }
}
