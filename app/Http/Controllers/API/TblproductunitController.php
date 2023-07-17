<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TblproductunitResource;
use App\Models\Tblproductunit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TblproductunitController extends Controller
{
    //
    public function index()
    {
        $posts = Tblproductunit::latest()->get();
        return response()->json([
            'data' => TblproductunitResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }
}
