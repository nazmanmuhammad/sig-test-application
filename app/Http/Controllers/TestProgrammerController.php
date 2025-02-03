<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestProgrammerController extends Controller
{
    public function getData()
    {
        $data = Http::get("https://bsby.siglab.co.id/api/test-programmer", [
            'email' => 'nazman.nadev@gmail.com'
        ]);

        return $data;
    }
}
