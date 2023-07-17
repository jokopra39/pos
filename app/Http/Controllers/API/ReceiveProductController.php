<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ReceiveProductResource;
use App\Models\ReceiveProduct;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReceiveProductController extends Controller
{
    //
    public function index()
    {
        $posts = ReceiveProduct::latest()->get();
        return response()->json([
            'data' => ReceiveProductResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }
}
