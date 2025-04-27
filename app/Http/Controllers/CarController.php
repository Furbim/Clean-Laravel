<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function __invoke(){
        return '__invoke';
    }
    public function index()
    {
        return 'Index Method from car controller';
    }
}
