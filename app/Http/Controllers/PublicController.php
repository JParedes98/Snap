<?php

namespace App\Http\Controllers;

use App\Models\Link;

class PublicController extends Controller
{
    public function GetAllLinks(){
        $links = Link::all();
        return response()->json($links, 200);
    }

    public function GetAllFiles(){}

    public function GetAllSnippets(){}
}
