<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index'); // Asegúrate de tener una vista en 'resources/views/admin/index.blade.php'
    }
    
}
