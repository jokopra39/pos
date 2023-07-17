<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TblcustomerResource;
use App\Models\Tblcustomer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TblcustomerController extends Controller
{
    //
    public function index()
    {
        $posts = Tblcustomer::latest()->get();
        return response()->json([
            'data' => TblcustomerResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }
}
