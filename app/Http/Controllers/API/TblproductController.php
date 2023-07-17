<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TblproductResource;
use App\Models\Tblproduct;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TblproductController extends Controller
{
    //
    public function index()
    {
        $posts = Tblproduct::latest()->get();
        return response()->json([
            'data' => TblproductResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }
}
