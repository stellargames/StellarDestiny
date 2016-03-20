<?php

//dataform routing
Burp::post(
    null, 'process=1', [
        'as' => 'save',
        function () {
            BurpEvent::queue('dataform.save');
        },
    ]
);

//datagrid routing
Burp::get(
    null, 'page/(\d+)', [
        'as' => 'page',
        function ($page) {
            BurpEvent::queue('dataset.page', [ $page ]);
        },
    ]
);
Burp::get(
    null, 'ord=(-?)(\w+)', [
        'as' => 'orderby',
        function ($direction, $field) {
            $direction = ($direction === '-') ? 'DESC' : 'ASC';
            BurpEvent::queue('dataset.sort', [ $direction, $field ]);
        },
    ]
)->remove('page');

Route::get(
    'rapyd-ajax/{hash}', [ 'as' => 'rapyd.remote', 'uses' => '\Zofe\Rapyd\Controllers\AjaxController@getRemote' ]
);

