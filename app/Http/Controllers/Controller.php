<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Controller dasar yang digunakan oleh seluruh controller di aplikasi.
 */
abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests;
}
