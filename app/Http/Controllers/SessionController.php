<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
//        session();
        $request->session()->put('userId', 'Angga');
        $request->session()->put('isMember', 'true');
        return "Ok";
    }

    public function getSession(Request $request): string
    {
        $userId = $request->session()->get('userId', 'guest');
        $isMember = $request->session()->get('isMember', 'false');

        return "User Id : {$userId} Is member : {$isMember}";
    }
}
