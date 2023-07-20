<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    // $user = DB::table('users')->insert([
    //     'name' => 'Sarthak',
    //     'email' => 'sarthak@bitfumes.com',
    //     'password' => 'password'
    // ]);
    // $users = DB::table('users')->get();
    // dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('login.github');


Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
    // dd($user->email);
    // dd($user);
    $user = User::updateOrCreate(['email' => $user->email], [
        // 'name' => $user->name,
        'password' => 'password',
    ]);

    Auth::login($user);
    return redirect('/dashboard');
 
    // $user->token
});

Route::middleware('auth')->group(function(){
    Route::resource('/ticket', TicketController::class);

    // Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
    // Route::post('/ticket/create', [TicketController::class, 'store'])->name('ticket.store');
});

