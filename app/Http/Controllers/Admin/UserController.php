<?php namespace Stellar\Http\Controllers\Admin;

use Response;
use Stellar\User;

class UserController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $grid = \DataGrid::source(User::with('faction'))->attributes(array('class' => 'table table-hover table-striped'));
        $grid->add('id', 'ID', true);
        $grid->add('status', 'Status', true);
        $grid->add('name', 'Name', true);
        $grid->add('faction.name', 'Faction', true);
        $grid->add('reputation', 'Reputation', true);
        $grid->add('alignment', 'Alignment', true);
        $grid->add('affiliation', 'Affiliation', true);
        $grid->add('created_at', 'Created', true);
        $grid->add('updated_at', 'Last change', true);
        $grid->add('email', 'Email address');
        return view('user.index', compact('grid'));
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
