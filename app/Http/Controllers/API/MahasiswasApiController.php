<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MahasiswasResource;
use App\Models\Mahasiswas;
use Illuminate\Support\Facades\Validator;

class MahasiswasApiController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Mahasiswas::latest()->get();
        return response()->json([
            'data' => MahasiswasResource::collection($posts),
            'message' => 'Fetch all mahasiswa',
            'success' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:155',
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        $post = Mahasiswas::create([
            'email' => $request->get('email'),
            'nama' => $request->get('nama'),
        ]);

        return response()->json([
            'data' => new MahasiswasResource($post),
            'message' => 'Post created successfully.',
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Mahasiswas $post)
    {
        return response()->json([
            'data' => new MahasiswasResource($post),
            'message' => 'Data post found',
            'success' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:155',
            'nama' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        // $post->update([
        //     'email' => $request->get('email'),
        //     'nama' => $request->get('nama'),
        // ]);
        $post = Mahasiswas::where('id', $request->id)
             ->update([
                    'nama' => $request->nama,
                    'email' => $request->email,
             ]);


        return response()->json([
            'data' => $post,
            'message' => 'updated successfully',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        //$mahasiswas->delete();
        Mahasiswas::where('id', $request->get('id'))->delete();
        return response()->json([
            'data' => $request->get('id'),
            'message' => 'Mahasiswa deleted successfully',
            'success' => true
        ]);
    }
}
