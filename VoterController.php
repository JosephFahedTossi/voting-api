<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VoterController extends Controller
{
        // search for a candidate
    public function search(Request $request) {
            // the key is the name if candidate
        $inputName = $request -> post('name');
            // query if input is equal or like a name in our candidate's name
        $Candidates = DB :: table('candidates') -> select('name') -> where('name',$inputName) ->
        orWhere('name','like','%'.$inputName.'%') -> get();
            // take a loop if the voter insert an non-empty key and verified
        if($Candidates && $inputName != "") {
            return json_encode([$Candidates], JSON_PRETTY_PRINT);
        }
        else
                return json_encode([
                    'message' => 'Please enter name of candidate.'
                ], JSON_PRETTY_PRINT);

    }
        // upload an image to a folder
    public function upload(Request $request){
        // validate that the image is a valid jpeg,png and gif image

        if ($request -> hasFile('VoterImage')) {
            $image = $request -> file('VoterImage');
            $name = 'VoterImage';
            $destinationPath = public_path('/images');
            $image -> move($destinationPath, $name);
            $this->save();

            return json_encode([ 'message' => 'Image Uploaded.', JSON_PRETTY_PRINT]);
        }
        else
            return json_encode([ 'message' => 'Image did not upload.', JSON_PRETTY_PRINT]);

    }

    public function vote(Request $request){
        // the key is the name if candidate
        $inputName = $request -> post('name');
        $CandidatesName = DB :: table('votes') -> select('CandidateName') -> get();

        if($inputName === $CandidatesName) {
            $key = DB :: table('votes') -> select('NumOfVotes') -> where('CandidateName',$inputName) -> increment('NumOfVotes') -> get();
            return json_encode([
                'Candidate '.$CandidatesName.'is'.$key
            ], JSON_PRETTY_PRINT);
        }
        else
            return json_encode([
                'No Candidate with such name'
            ], JSON_PRETTY_PRINT);
    }
}
