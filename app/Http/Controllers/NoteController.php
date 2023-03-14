<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
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
            $query = Note::where($request->input('columnSearch'), 'LIKE', '%' . $request->input('searchKey') . '%')->with([])->orderBy($orderBy, $orderSort)->paginate($paginations);
        } else {
            $query = Note::with([])->orderBy($orderBy, $orderSort)->paginate($paginations);
        }
        return NoteResource::collection($query)->additional([
            'code' => 200,
            'desc' => ''
        ]);
        // $model = Note::all();
        // return $model;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request): NoteResource
    {
        $query = Note::query()
            ->create([
                'note_num' => $request['note_num']
            ]);
        
        return (new NoteResource($query))->additional([
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
    public function show($id): NoteResource
    {
        $query = Note::findOrFail($id);
        return (new NoteResource($query))->additional([
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
    public function update(NoteRequest $request, $id) : NoteResource
    {
        $query = Note::findOrFail($id);
        $fields = $request->only($query->getFillable());
        $query->fill($fields);
        $query->save();
        return (new NoteResource($query))->additional([
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
    public function destroy($id) : NoteResource
    {
        $query = Note::findOrFail($id);
        $query->delete();
        return (new NoteResource($query))->additional([
            'code' => 200,
            'desc' => ''
        ]);
    }
}
