<?php

use App\WinWin\ApiRouter;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/docs');

ApiRouter::resource('users');