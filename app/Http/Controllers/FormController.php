<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function show(Request $request)
    {
        $text = $request->input('text');
        return view('index', compact('text'));
    }
}