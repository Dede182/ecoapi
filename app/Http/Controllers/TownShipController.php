<?php

namespace App\Http\Controllers;

use App\Models\TownShip;
use App\Http\Requests\StoreTownShipRequest;
use App\Http\Requests\UpdateTownShipRequest;

class TownShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTownShipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTownShipRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TownShip  $townShip
     * @return \Illuminate\Http\Response
     */
    public function show(TownShip $townShip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TownShip  $townShip
     * @return \Illuminate\Http\Response
     */
    public function edit(TownShip $townShip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTownShipRequest  $request
     * @param  \App\Models\TownShip  $townShip
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTownShipRequest $request, TownShip $townShip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TownShip  $townShip
     * @return \Illuminate\Http\Response
     */
    public function destroy(TownShip $townShip)
    {
        //
    }
}
