<?php

namespace Stellar\Http\Controllers\Admin;

use Stellar\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
}
