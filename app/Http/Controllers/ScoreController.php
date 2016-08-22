<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class ScoreController extends Controller
{
    public function election($id)
    {
        $election = DB::table('melections')->where('election_id', $id)->get();

        $count = 0;

        $studentAll = null;

        foreach ($election as $student)
        {
            $studentAll[$count] = DB::table('users')->where('stuId', $student->stuid)->first();
            ++$count;
        }

        $result = null;

        $count = 0;
        if($studentAll != null)
        {
            foreach ($studentAll as $stu)
            {
                foreach ($election as $el)
                {
                    if($el->stuid == $stu->stuId)
                    {
                        $result[$count] = array(
                            'name' => $stu->name,
                            'stuid' => $stu->stuId,
                            'count' => $el->count
                        );
                        $count++;
                    }
                }
            }
        }


        return view('electionView', compact('result'));
    }
}
