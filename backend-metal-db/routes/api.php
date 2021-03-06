<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('', ['middleware' => 'cors', function() {
//     return 'You did it!';



// User Methods

    Route::post('/register', [UserController::class, 'registerUser']);
    Route::get('/users', [UserController::class, 'getAllUsers']);
    Route::get('/profile/{id}',[UserController::class, 'getUserById']);
    Route::get('/profile/{nickname}',[UserController::class, 'getUserByNickname']);
    Route::post('/login', [UserController::class, 'loginUser']);
    Route::post('/logout', [UserController::class, 'logoutUser']);
    Route::put('/user',[UserController::class, 'updateUser']);
    Route::delete('/user',[UserController::class, 'deleteUser']); 

// }]);

//Product Methods


//Artist Methods

Route::post('/create', [ArtistController::class, 'createArtist']);
Route::get('/artists', [ArtistController::class, 'getAllArtists']);
Route::get('/artist/{id}',[ArtistController::class, 'getArtistById']);
Route::get('/artistName/{name}',[ArtistController::class, 'getArtistByName']);
Route::get('/artistGenre/{genre}', [ArtistController::class, 'getArtistByGenre']);
Route::get('/artistCountry/{country}', [ArtistController::class, 'getArtistByCountry']);
Route::put('/artist',[ArtistController::class, 'updateArtist']);
Route::delete('/artist',[ArtistController::class, 'deleteArtist']); 