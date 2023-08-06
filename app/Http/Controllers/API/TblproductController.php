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

    public function gets()
    {
        $posts = Tblproduct::latest()->get();
        return response()->json([
            'data' => TblproductResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $product = Tblproduct::where('product_name', 'like', "%" . $keyword . "%")->get();
        //return view('users.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);
        // return response()->json([
        //     'data' => TblproductResource::collection($product),
        //     'message' => 'Fetch all posts',
        //     'success' => true
        // ]);
        return response()->json([
            'data' => $product
         ]);
    }

    public function update(Request $request, Tblproduct $post)
    {
        $validator = Validator::make($request->all(), [
            'product_code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        $post->update([
            'product_code' => $request->get('product_code'),
            'product_name' => $request->get('product_name'),
        ]);

        return response()->json([
            'data' => new TblproductResource($post),
            'message' => 'Post updated successfully',
            'success' => true
        ]);
    }
    public function show(Tblproduct $post)
    {
        return response()->json([
            'data' => new TblproductResource($post),
            'message' => 'Data post found',
            'success' => true
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Tblproduct $post)
    {
        $post->delete();

        return response()->json([
            'data' => [],
            'message' => 'Post deleted successfully',
            'success' => true
        ]);
    }
}
