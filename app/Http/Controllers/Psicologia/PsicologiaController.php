<?php

namespace Sise\Http\Controllers\Psicologia;

use Illuminate\Http\Request;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use View;

class PsicologiaController extends Controller
{
    /**
     * generar la vista principal de psicologia
     *
     * @return View
     */
    public function index()
    {
        return View::make('psicologia.principal');
    }
}
