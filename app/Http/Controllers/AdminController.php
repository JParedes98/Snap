<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function GetResource($resource) {}

    public function StoreResource(Request $request, $resource) {}

    public function UpdateResource(Request $request, $resource) {}

    public function DeleteResource($resource) {}
}
