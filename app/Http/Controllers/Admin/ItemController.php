<?php namespace Stellar\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Response;
use Stellar\Models\Items\Item;

class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $filter = \DataFilter::source(new Item);
        $filter->add('type', 'Type', 'text');
        $filter->add('value', 'Value', 'text');
        $filter->add('updated_at', 'Last change', 'daterange')->format('m/d/Y', 'en');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();

        $grid = \DataGrid::source($filter)->attributes([ 'class' => 'table table-hover table-striped' ]);
        $grid->add('id', 'ID', true)->cell(
            function ($value) {
                return link_to(action('Admin\ItemController@edit') . '?show=' . $value, $value);
            }
        );
        $grid->add('type', 'Type', true);
        $grid->add('name', 'Name', true);
        $grid->add('description', 'Description', true);
        $grid->add('value', 'Value', true);
        $grid->add('created_at', 'Created', true);
        $grid->add('updated_at', 'Last change', true);
        $grid->edit(action('Admin\ItemController@edit'), 'Edit', 'modify|delete');

        return view('admin.item.index', compact('filter', 'grid'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit() {
        $edit = \DataEdit::source(new Item);
        $edit->link(action('Admin\ItemController@index'), "Items", "TR")->back();
        $edit->add('type', 'Type', 'select')->options(array_keys(Item::getSingleTableTypeMap()))->rule('required');
        $edit->add('name', 'Name', 'text')->rule('required');
        $edit->add('description', 'Description', 'textarea');
        $edit->add('value', 'Value', 'number');

        return $edit->view('admin.item.edit', compact('edit'));
    }

}
