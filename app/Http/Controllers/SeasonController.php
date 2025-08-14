<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class SeasonController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('season/Index');
    }
}
