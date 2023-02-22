<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
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
            $query = Item::where($request->input('columnSearch'), 'LIKE', '%' . $request->input('searchKey') . '%')->with(['kode_barang', 'kywn_code'])->orderBy($orderBy, $orderSort)->paginate($paginations);
        } else {
            $query = Item::with(['kode_barang', 'kywn_code'])->orderBy($orderBy, $orderSort)->paginate($paginations);
        }
        return ItemResource::collection($query)->additional([
            'code' => 200,
            'desc' => ''
        ]);
        // $model = Item::all();
        // return $model;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request): ItemResource
    {
        $query = Item::query()
            ->create([
                'kode_barang_id' => $request['kode_barang_id'],
                'seri' => $request['seri'],
                'quantity' => $request['quantity'],
                'kywn_code_id' => $request['karyawan_id'],
                'verify' => $request['verify'],
            ]);

        return (new ItemResource( Item::with(['kode_barang', 'kywn_code'])->findOrFail($query->id) ))->additional([
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
    public function show($id): ItemResource
    {
        $query = Item::with(['kode_barang', 'kywn_code'])->findOrFail($id);
        return (new ItemResource($query))->additional([
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
    public function update(ItemRequest $request, $id) : ItemResource
    {
        $query = Item::with(['kode_barang', 'kywn_code'])->findOrFail($id);
        $fields = $request->only($query->getFillable());
        $query->fill($fields);
        $query->save();
        return (new ItemResource($query))->additional([
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
    public function destroy($id) : ItemResource
    {
        $query = Item::with([])->findOrFail($id);
        $query->delete();
        return (new ItemResource($query))->additional([
            'code' => 200,
            'desc' => ''
        ]);
    }
}
