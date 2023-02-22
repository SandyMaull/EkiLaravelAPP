<?php

namespace App\Http\Controllers;

use App\Http\Requests\MerkRequest;
use App\Http\Resources\MerkResource;
use App\Models\Item\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
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
            $query = Merk::where($request->input('columnSearch'), 'LIKE', '%' . $request->input('searchKey') . '%')->with([])->orderBy($orderBy, $orderSort)->paginate($paginations);
        } else {
            $query = Merk::with([])->orderBy($orderBy, $orderSort)->paginate($paginations);
        }
        return MerkResource::collection($query)->additional([
            'code' => 200,
            'desc' => ''
        ]);
        // $model = Merk::all();
        // return $model;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MerkRequest $request): MerkResource
    {
        $query = Merk::query()
            ->create([
                'name' => $request['name']
            ]);
        
        return (new MerkResource($query))->additional([
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
    public function show($id): MerkResource
    {
        $query = Merk::findOrFail($id);
        return (new MerkResource($query))->additional([
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
    public function update(MerkRequest $request, $id) : MerkResource
    {
        $query = Merk::findOrFail($id);
        $fields = $request->only($query->getFillable());
        $query->fill($fields);
        $query->save();
        return (new MerkResource($query))->additional([
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
    public function destroy($id) : MerkResource
    {
        $query = Merk::findOrFail($id);
        $query->delete();
        return (new MerkResource($query))->additional([
            'code' => 200,
            'desc' => ''
        ]);
    }
}
