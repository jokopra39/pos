<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SalesResource;
use App\Models\Sales;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SalesController extends Controller
{
    //
    public function index()
    {
        $posts = Sales::latest()->get();
        return response()->json([
            'data' => SalesResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'invoice_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        $post = Sales::create([
            'invoice_id' => $request->get('invoice_id'),
            'product_id' => $request->get('product_id'),
            'unit_price' => $request->get('unit_price'),
            'quantity' => $request->get('quantity'),
            'sub_total' => $request->get('sub_total')
        ]);

        return response()->json([
            'data' => new SalesResource($post),
            'message' => 'Post created successfully.',
            'success' => true
        ]);
    }
}
