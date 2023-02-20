<?php

namespace App\Http\Controllers;

use App\Http\Requests\KodeBarangRequest;
use App\Http\Resources\KodeBarangResource;
use App\Models\Item\KodeBarang;
use Illuminate\Http\Request;

class KodeBarangController extends Controller
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
        $query = KodeBarang::with(['merk'])->orderBy($orderBy, $orderSort)->paginate($paginations);
        return KodeBarangResource::collection($query)->additional([
            'code' => 200,
            'desc' => ''
        ]);
        // $model = KodeBarang::all();
        // return $model;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KodeBarangRequest $request): KodeBarangResource
    {
        // return $request;
        $query = KodeBarang::query()
            ->create([
                'merk_id' => $request['merk_id'],
                'code' => $request['code'],
            ]);

        return (new KodeBarangResource( KodeBarang::with(['merk'])->findOrFail($query->id) ))->additional([
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
    public function show($id): KodeBarangResource
    {
        $query = KodeBarang::with(['merk'])->findOrFail($id);
        return (new KodeBarangResource($query))->additional([
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
    public function update(KodeBarangRequest $request, $id) : KodeBarangResource
    {
        $query = KodeBarang::with(['merk'])->findOrFail($id);
        $fields = $request->only($query->getFillable());
        $query->fill($fields);
        $query->save();
        return (new KodeBarangResource($query))->additional([
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
    public function destroy($id) : KodeBarangResource
    {
        $query = KodeBarang::with(['merk'])->findOrFail($id);
        $query->delete();
        return (new KodeBarangResource($query))->additional([
            'code' => 200,
            'desc' => ''
        ]);
    }
}
