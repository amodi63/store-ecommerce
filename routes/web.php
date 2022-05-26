<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
<<<<<<< HEAD
 */

// Route::get('/', function () {
//     return view('layouts.admin');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/admin.php';
require __DIR__ . '/front.php';
=======
*/

Route::get('/', function () {
    return view('welcome');
});
>>>>>>> f8bcc95f63d19519f0259da44a5f546bcb293e1b
