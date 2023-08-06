<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tblproduct;
use Illuminate\Http\Request;
use App\Http\Resources\PurchaseOrderResource;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = PurchaseOrder::latest()->get();
        return response()->json([
            'data' => PurchaseOrderResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
    }

    public function setstock(Request $request)
    {
        // {
        //     $report = Report::where('id', $id)->first();
        //     $report->credits += Input::get('credits');

        //     // if the report has a user, update it
        //     if ($report->user) {
        //         $report->user->credits += Input::get('credits');
        //         $report->user->save();
        //     }

        //     $report->save();
        //     return redirect()->back();
        // }

        // $data = $request->all();
        // $finalArray = array();
        // foreach($data as $key=>$value){
        //    array_push($finalArray, array(
        //                 'fltno'=>$value['sflt'],
        //                 'model'=>$value['smodel'],
        //                 'engine'=>$value['sengine'],
        //                 'loc'=>$value['sloc'],
        //                 'serviceType'=>$value['sstye'],
        //                 'nextSvr'=> $value['snsvr'] )
        //    );
        // });

        // Model::insert($finalArray);


        // User::where('id',$user_id)->update(['email' => $inputteacher['email']]);
        $data = PurchaseOrder::where('purchase_order_id', $request->get('id'))->first();
        $product = Tblproduct::where('product_id', $data->product_id)
            ->update(['unit_in_stock' => 999]);
        // $data->update($request->all());
        // if (count($request->product_name) > 0) {
        //     foreach ($request->product_name as $item => $v) {
        //         $data2 = array(
        //             'order_id' => $id,
        //             'product_name' => $request->product_name[$item],
        //             'qty' => $request->qty[$item],
        //             'tonise' => $request->tonise[$item]
        //         );
        //         $product->update($data2);
        //     }
        // }
        // User::where('active', 1)
        //     ->where('destination', 'San Diego')
        //     ->where('invalidlogs', '>', 3)
        //     ->update(['status', =>, 'disable']); 
        // Tblproduct::update([
        //     'unit_in_stock' => 999,//$data->get('quantity'),
        // ]);
        return response()->json([
            'data' => $product,
            'message' => 'Post successfully',
            'success' => true
        ]);
    }

    public function join(Request $request)
    {
        //SELECT purchase_orders.product_id, purchase_orders.unit_price, purchase_orders.quantity, tblproducts.product_name  FROM purchase_orders JOIN tblproducts 
// on purchase_orders.product_id = tblproducts.product_id WHERE purchase_orders.product_id = 3 
// group by product_id
        $join = PurchaseOrder::select(
            'purchase_orders.*',
            'tblproducts.product_name'
        )
            ->join('tblproducts', 'tblproducts.product_id', '=', 'purchase_orders.product_id')
            ->groupBy('product_id')
            ->where('tblproducts.product_id', 3)
            ->get();
        return response()->json([
            'data' => $join,
            'message' => 'Post successfully',
            'success' => true
        ]);
    }

    public function pagination(Request $request)
    {
        $count = PurchaseOrder::count();
        $paging = $request->get('paging');
        $skip = $request->get('skip') * 5;
        $limit = $paging; // the limit
        $collection = PurchaseOrder::skip($skip)->take($limit)->get();
        return response()->json([
            'data' => $collection,
            'count' => $count,
            'message' => 'Post pagination successfully',
            'success' => true
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'supplier_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        $post = PurchaseOrder::create([
            'product_id' => $request->get('product_id'),
            'quantity' => $request->get('quantity'),
            'unit_price' => $request->get('unit_price'),
            'sub_total' => $request->get('sub_total'),
            'supplier_id' => $request->get('supplier_id'),
            'tax_id' => $request->get('tax_id'),
            'user_id' => $request->get('user_id')
        ]);

        return response()->json([
            'data' => new PurchaseOrderResource($post),
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
    public function show(PurchaseOrder $post)
    {
        return response()->json([
            'data' => new PurchaseOrderResource($post),
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
    public function update(Request $request, PurchaseOrder $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:155',
            'content' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        $post->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'status' => $request->get('status'),
            'slug' => Str::slug($request->get('title'))
        ]);

        return response()->json([
            'data' => new PurchaseOrderResource($post),
            'message' => 'Post updated successfully',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(PurchaseOrder $post)
    {
        $post->delete();

        return response()->json([
            'data' => [],
            'message' => 'Post deleted successfully',
            'success' => true
        ]);
    }
}