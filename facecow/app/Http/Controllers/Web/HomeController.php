<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Renderiza la landing page pública de la plataforma.
     */
    public function index()
    {
        return view('web.home');
    }
}
