<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TblproductcategoryResource;
use App\Models\Tblproductcategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TblproductcategoryController extends Controller
{
    //
    public function index()
    {
        $posts = Tblproductcategory::latest()->get();
        return response()->json([
            'data' => TblproductcategoryResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }
}
