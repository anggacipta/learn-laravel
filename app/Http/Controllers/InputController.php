<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function helloRequest(Request $request): string
    {
        $name = $request->input('nama');
//        $name = $request->name;
        return "Hello $name";
    }

    public function helloFirst(Request $request): string
    {
        $firstName = $request->input('name.first');
        return "Hello $firstName";
    }

    public function helloInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }

    public function helloArray(Request $request): string
    {
        $name = $request->input("products.*.name");
        return json_encode($name);
    }
}
