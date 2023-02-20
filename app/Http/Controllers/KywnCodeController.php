<?php

namespace App\Http\Controllers;

use App\Http\Requests\KywnCodeRequest;
use App\Http\Resources\KywnCodeResource;
use App\Models\Item\Kywn_Code;
use Illuminate\Http\Request;

class KywnCodeController extends Controller
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
        $query = Kywn_Code::with([])->orderBy($orderBy, $orderSort)->paginate($paginations);
        return KywnCodeResource::collection($query)->additional([
            'code' => 200,
            'desc' => ''
        ]);
        // $model = Kywn_Code::all();
        // return $model;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KywnCodeRequest $request): KywnCodeResource
    {
        $query = Kywn_Code::query()
            ->create([
                'name' => $request['name']
            ]);
        
        return (new KywnCodeResource($query))->additional([
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
    public function show($id): KywnCodeResource
    {
        $query = Kywn_Code::findOrFail($id);
        return (new KywnCodeResource($query))->additional([
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
    public function update(KywnCodeRequest $request, $id) : KywnCodeResource
    {
        $query = Kywn_Code::findOrFail($id);
        $fields = $request->only($query->getFillable());
        $query->fill($fields);
        $query->save();
        return (new KywnCodeResource($query))->additional([
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
    public function destroy($id) : KywnCodeResource
    {
        $query = Kywn_Code::findOrFail($id);
        $query->delete();
        return (new KywnCodeResource($query))->additional([
            'code' => 200,
            'desc' => ''
        ]);
    }
}
