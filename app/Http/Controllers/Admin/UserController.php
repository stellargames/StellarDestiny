<?php namespace Stellar\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Response;
use Stellar\Models\User;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $filter = \DataFilter::source(User::with('faction'));
        $filter->add('name', 'Name', 'text');
        $filter->add('faction.name', 'Faction', 'autocomplete');
        $filter->add('updated_at', 'Last change', 'daterange')->format('m/d/Y', 'en');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();

        $grid = \DataGrid::source($filter)->attributes([ 'class' => 'table table-hover table-striped' ]);
        $grid->add('id', 'ID', true)->cell(
            function ($value) {
                return link_to(action('Admin\UserController@edit') . '?show=' . $value, $value);
            }
        );;
        $grid->add('status', 'Status', true);
        $grid->add('name', 'Name', true);
        $grid->add('faction.name', 'Faction', true);
        $grid->add('reputation', 'Reputation', true);
        $grid->add('alignment', 'Alignment', true);
        $grid->add('affiliation', 'Affiliation', true);
        $grid->add('created_at', 'Created', true);
        $grid->add('updated_at', 'Last change', true);
        $grid->add('email', 'Email address');
        $grid->edit(action('Admin\UserController@edit'), 'Edit', 'modify|delete');

        return view('admin.user.index', compact('filter', 'grid'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        $edit = \DataEdit::source(new User);
        $edit->link(action('Admin\UserController@index'), "Users", "TR")->back();
        $edit->add('status', 'Status', 'checkboxgroup')->options(User::$statusEnum);
        $edit->add('name', 'Name', 'text')->rule('required');
        $edit->add('faction.name', 'Faction', 'autocomplete');
        $edit->add('reputation', 'Reputation', 'text');
        $edit->add('alignment', 'Alignment', 'text');
        $edit->add('affiliation', 'Affiliation', 'text');
        $edit->add('email', 'Email', 'text')->rule('required');

        return $edit->view('admin.user.edit', compact('edit'));
    }

}
