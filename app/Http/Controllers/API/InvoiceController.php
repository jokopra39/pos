<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    //
    public function index()
    {
        $posts = Invoice::latest()->get();
        return response()->json([
            'data' => InvoiceResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }
}
