<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TblsupplierResource;
use App\Models\Tblsupplier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class TblsupplierController extends Controller
{
    //
    public function index()
    {
        $posts = Tblsupplier::latest()->get();
        return response()->json([
            'data' => TblsupplierResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }
}
