<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BundlesController extends Controller
{
    public function index() {

        $data = [
            'subtitle'  => 'Bundles',
            'bundles'   => collect(['teste' => 'teste']) // empty collection
        ];

        return view('bundles.home', $data);
    }
}
