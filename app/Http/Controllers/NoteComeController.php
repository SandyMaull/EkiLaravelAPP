<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteComeRequest;
use App\Http\Resources\NoteComeResource;
use App\Models\NoteCome;
use Illuminate\Http\Request;

class NoteComeController extends Controller
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
            $query = NoteCome::where($request->input('columnSearch'), 'LIKE', '%' . $request->input('searchKey') . '%')->with(['item', 'note'])->orderBy($orderBy, $orderSort)->paginate($paginations);
        } else {
            $query = NoteCome::with(['item', 'note'])->orderBy($orderBy, $orderSort)->paginate($paginations);
        }
        return NoteComeResource::collection($query)->additional([
            'code' => 200,
            'desc' => ''
        ]);
        // $model = NoteCome::all();
        // return $model;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteComeRequest $request): NoteComeResource
    {
        $query = NoteCome::query()
            ->create([
                'item_id' => $request['item_id'],
                'note_id' => $request['note_id'],
                'verify' => $request['verify']
            ]);

        return (new NoteComeResource( NoteCome::with(['item', 'note'])->findOrFail($query->id) ))->additional([
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
    public function show($id): NoteComeResource
    {
        $query = NoteCome::with(['item', 'note'])->findOrFail($id);
        return (new NoteComeResource($query))->additional([
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
    public function update(NoteComeRequest $request, $id) : NoteComeResource
    {
        $query = NoteCome::with(['item', 'note'])->findOrFail($id);
        $fields = $request->only($query->getFillable());
        $query->fill($fields);
        $query->save();
        return (new NoteComeResource($query))->additional([
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
    public function destroy($id) : NoteComeResource
    {
        $query = NoteCome::with([])->findOrFail($id);
        $query->delete();
        return (new NoteComeResource($query))->additional([
            'code' => 200,
            'desc' => ''
        ]);
    }
}
