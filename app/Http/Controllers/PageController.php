<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function inicio()
    {
        return view('pages.inicio');
    }

    public function nosotros()
    {
        return view('pages.nosotros');
    }

    public function servicios()
    {
        return view('pages.servicios');
    }

    public function salud()
    {
        return view('pages.salud');
    }

    public function educacion()
    {
        return view('pages.educacion');
    }

    public function directorio()
    {
        return view('pages.directorio');
    }
}
