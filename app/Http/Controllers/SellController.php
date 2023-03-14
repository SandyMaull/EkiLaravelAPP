<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellRequest;
use App\Http\Resources\SellResource;
use App\Models\Sell;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginations = ($request->input('pagination') != null) ? $request->input('pagination') : 5;
        $orderBy = ($request->input('orderBy') != null) ? $request->input('orderBy') : 'id';
        $orderSort = ($request->input('orderSort') != null) ? $request->input('orderSort') : 'asc';
        if ($request->input('columnSearch') != null && $request->input('searchKey') != null) {
            $query = Sell::where($request->input('columnSearch'), 'LIKE', '%' . $request->input('searchKey') . '%')->with(['item', 'kywn_code'])->orderBy($orderBy, $orderSort)->paginate($paginations);
        } else {
            $query = Sell::with(['item', 'kywn_code'])->orderBy($orderBy, $orderSort)->paginate($paginations);
        }
        return SellResource::collection($query)->additional([
            'code' => 200,
            'desc' => ''
        ]);
        // $model = Sell::all();
        // return $model;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellRequest $request): SellResource
    {
        $query = Sell::query()
            ->create([
                'item_id' => $request['item_id'],
                'quantity' => $request['quantity'],
                'kywn_code_id' => $request['karyawan_id'],
                'status' => $request['status'],
            ]);

        return (new SellResource( Sell::with(['item', 'kywn_code'])->findOrFail($query->id) ))->additional([
            'code' => 200,
            'desc' => ''
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): SellResource
    {
        $query = Sell::with(['item', 'kywn_code'])->findOrFail($id);
        return (new SellResource($query))->additional([
            'code' => 200,
            'desc' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SellRequest $request, $id) : SellResource
    {
        $query = Sell::with(['item', 'kywn_code'])->findOrFail($id);
        $fields = $request->only($query->getFillable());
        $query->fill($fields);
        $query->save();
        return (new SellResource($query))->additional([
            'code' => 200,
            'desc' => ''
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) : SellResource
    {
        $query = Sell::with([])->findOrFail($id);
        $query->delete();
        return (new SellResource($query))->additional([
            'code' => 200,
            'desc' => ''
        ]);
    }
}
