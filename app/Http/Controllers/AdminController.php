<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard(): Response {
        return Inertia::render('Admin/Dashboard');
    }
}
