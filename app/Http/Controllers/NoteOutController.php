<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteOutRequest;
use App\Http\Resources\NoteOutResource;
use App\Models\NoteOut;
use Illuminate\Http\Request;

class NoteOutController extends Controller
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
            $query = NoteOut::where($request->input('columnSearch'), 'LIKE', '%' . $request->input('searchKey') . '%')->with(['sell', 'note'])->orderBy($orderBy, $orderSort)->paginate($paginations);
        } else {
            $query = NoteOut::with(['sell', 'note'])->orderBy($orderBy, $orderSort)->paginate($paginations);
        }
        return NoteOutResource::collection($query)->additional([
            'code' => 200,
            'desc' => ''
        ]);
        // $model = NoteOut::all();
        // return $model;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteOutRequest $request): NoteOutResource
    {
        $query = NoteOut::query()
            ->create([
                'sell_id' => $request['sell_id'],
                'note_id' => $request['note_id']
            ]);

        return (new NoteOutResource( NoteOut::with(['sell', 'note'])->findOrFail($query->id) ))->additional([
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
    public function show($id): NoteOutResource
    {
        $query = NoteOut::with(['sell', 'note'])->findOrFail($id);
        return (new NoteOutResource($query))->additional([
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
    public function update(NoteOutRequest $request, $id) : NoteOutResource
    {
        $query = NoteOut::with(['sell', 'note'])->findOrFail($id);
        $fields = $request->only($query->getFillable());
        $query->fill($fields);
        $query->save();
        return (new NoteOutResource($query))->additional([
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
    public function destroy($id) : NoteOutResource
    {
        $query = NoteOut::with([])->findOrFail($id);
        $query->delete();
        return (new NoteOutResource($query))->additional([
            'code' => 200,
            'desc' => ''
        ]);
    }
}
