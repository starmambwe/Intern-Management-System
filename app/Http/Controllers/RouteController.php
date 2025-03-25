<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteController extends Controller
{
    //
    public function loadPageIntoElement(Request $request)
    {
        $page = $request->input('viewUrl');
        return view($page);
    }
}
