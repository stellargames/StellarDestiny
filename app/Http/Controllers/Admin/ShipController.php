<?php namespace Stellar\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Response;
use Stellar\Models\Items\Jumpstore;
use Stellar\Models\Ship;
use Stellar\Models\ShipType;
use Stellar\Models\Star;

class ShipController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $shipType = ShipType::whereName('Explorer')->first();
        $star = Star::random()->first();
        $ship = new Ship($shipType, auth()->user(), $star, 'Serenity');
        $ship->credits = 1000;
        $ship->energy = 50;
        $ship->save();
        $item = Jumpstore::whereValue(1)->get()->random();
        $ship->items()->attach($item, ['amount' => 1]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

    }

}
