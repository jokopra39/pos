<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TbltaxResource;
use App\Models\Tbltax;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TbltaxController extends Controller
{
    //
    public function index()
    {
        $posts = Tbltax::latest()->get();
        return response()->json([
            'data' => TbltaxResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }
}
