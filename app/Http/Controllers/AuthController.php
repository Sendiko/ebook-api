<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function me()
    {
        $biodata = array(
            "NIS" => 3103120150,
            "nama" => "Muhammad Rizky Sendiko",
            "phone" => 6282240626760,
            "class" => "XII RPL 5"
        );
        return json_encode($biodata);
    }
}
