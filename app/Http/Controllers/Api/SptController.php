<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SptResource;
use App\Models\Spt;
use Illuminate\Http\Request;

class SptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spts = Spt::all();
        return SptResource::collection($spts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'no_bpe_ntte' => 'required|string|max:20|unique:spt',
           'masa_tahun_pajak' => 'required|date',
            'pbtl_ke' => 'required|integer',
            'tanggal_kirim' => 'required|date',
        ]);

        $spt = Spt::create($request->all());
        return response()->json($spt, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $spt = Spt::findOrFail($id);
        return response()->json($spt);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_bpe_ntte' => 'sometimes|required|string|max:20|unique:spt,no_bpe_ntte,' . $id,
            'masa_tahun_pajak' => 'sometimes|required|date',
            'pbt_ke' => 'sometimes|required|integer',
            'tanggal_kirim' => 'sometimes|required|date',
        ]);

        $spt = Spt::findOrFail($id);
        $spt->update($request->all());

        return response()->json($spt);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Spt::destroy($id);
        return response()->json(null, 204);
    }
}
