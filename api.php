<?php

use Illuminate\Http\Request;


//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//
//
//
//
//
//});


// an api to search for the candidate's name
Route:: post('SearchCandidates', 'VoterController@search');

// an api to upload the image to folder voter image
Route:: post('UploadImage', 'VoterController@upload');

// an api to vote for a certain candidate
Route:: post('vote', 'VoterController@vote');
