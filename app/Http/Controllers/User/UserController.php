<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //election list
    public function election()
    {
        if(!(\Session::has('user')))
        {
            return redirect('/login');
        }

        $id = \Session::get('user');

        $data = DB::table('users')->where('id',$id)->first();

        //$filter = DB::table('electionSelect')->where('stuid', $data->stuId)->get();

        $dataAll = DB::table('elections')->get();

        /*$result = null;
        $count = 0;

        if($filter)
        {
            foreach ($dataAll as $election)
            {
                foreach ($filter as $stu)
                {
                    if($election->id != $stu->election_id)
                    {
                        $result[$count] = $election;
                        $count++;
                    }
                }
            }
        }
        else
        {
            $result = $dataAll;
        */
        $result = $dataAll;
        return view('user.election', compact(['data','result']));
    }

    public function electionSelect($idE)
    {
        if(!(\Session::has('user')))
        {
            return redirect('/login');
        }

        $id = \Session::get('user');

        $data = DB::table('users')->where('id',$id)->first();

        $election = DB::table('elections')->where('id',$idE)->first();

        $filter = DB::table('electionSelect')->where('stuid', $data->stuId)->get();

        foreach ($filter as $stu)
        {
            if($stu->election_id == $idE)
            {
                return redirect('/')
                    ->with('message', 'You can not select it.');
            }
        }

        $countChoice = $election->countChoice;
        $countChoice2 = $election->countChoice2;

        if($election->limitType == "N")
        {
            $dataAll = DB::table('melections')->where('election_id',$idE)->get();

            $count = 0;

            $studentAll = null;

            foreach ($dataAll as $student)
            {
                $studentAll[$count] = DB::table('users')->where('stuId', $student->stuid)->first();
                ++$count;
            }
        }
        elseif ($election->limitType == "F")
        {
            $dataAll = DB::table('melections')->where('election_id',$idE)->get();

            $count = 0;

            $studentAll = null;

            foreach ($dataAll as $student)
            {
                $result = DB::table('users')->where('stuId', $student->stuid)->first();

                if($result->field == $data->field)
                {
                    $studentAll[$count] = DB::table('users')->where('stuId', $student->stuid)->first();
                    ++$count;
                }
            }
        }
        else
        {
            $dataAll = DB::table('melections')->where('election_id',$idE)->get();

            $count = 0;

            $studentAll = null;

            foreach ($dataAll as $student)
            {
                $result = DB::table('users')->where('stuId', $student->stuid)->first();

                if($result->year == $data->year)
                {
                    $studentAll[$count] = DB::table('users')->where('stuId', $student->stuid)->first();
                    ++$count;
                }
            }
        }

        return view('user.select', compact(['data','studentAll','countChoice','idE','countChoice2']));
    }

    public function electionSelectPost(Request $request)
    {
        $selects = $request->input('select');
        $zero = $request->input('zero');
        $choice = $request->input('minchoice');
        $choice2 = $request->input('maxchoice');
        $idE = $request->input('election_id');

        $id = \Session::get('user');

        $data = DB::table('users')->where('id',$id)->first();

        $count = 0;

        if($selects)
        {
            foreach ($selects as $select) {
                $count++;
            }
        }
        if($zero)
        {
            DB::table('electionSelect')->insert(
                [
                    'election_id' => $idE,
                    'stuid' => $data->stuId,
                ]
            );
            return redirect('/')->with('message','Your request saved');
        }
        if($count > $choice2)
        {
            return redirect('/select/'.$idE)
                ->with('message', 'Your selected more of choice');
        }
        elseif($count < $choice)
        {
            return redirect('/select/'.$idE)
                ->with('message', 'Your selected fewer of choice');
        }
        elseif($count > 0 && $count <= $choice2 && $count >= $choice)
        {
            foreach ($selects as $select)
            {
                $e = DB::table('melections')->where('stuid',$select)->first();
                $c = $e->count;
                DB::table('melections')->where('stuid',$select)->update(
                    [
                        'count' => ++$c,
                    ]
                );
            }

            DB::table('electionSelect')->insert(
                [
                    'election_id' => $idE,
                    'stuid' => $data->stuId,
                 ]
            );

            return redirect('/')->with('message','Your request saved');
        }
    }

    public function page($id)
    {
        $data = DB::table('users')->where('id',$id)->first();

        return view('page',compact('data'));
    }
}
