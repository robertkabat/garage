<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
class SpaController extends Controller
{
    public function index()
    {
        return view('app');
    }
}
