<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use File;

class AdminController extends Controller
{
    //Index
    public function index()
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $dataAll = DB::table('elections')->get();

        return view('admin.index', compact(['data','dataAll']));
    }

    //Setting User
    public function setting()
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }
        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        return view('admin.setting', compact('data'));
    }

    public function settingPost(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $id = $request->input('id');
        $password = $request->input('password');

        if($password != "")
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255',
                'name' => 'required|max:255|min:3',
                'password' => 'required|min:6',
                'repassword' => 'required|min:6|same:password',
            ]);

            if ($validator->fails()) {
                return redirect('/admin/setting')
                    ->withErrors($validator, 'setting')
                    ->withInput();
            }



            DB::table('admins')->where('id', $id)->update(
                [
                    'name' => $name,
                    'email' => $email,
                    'password' => encrypt($password),
                ]
            );

            return redirect('/admin')
                ->with('message' , 'Change your information');
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255',
                'name' => 'required|max:255|min:3',
            ]);

            if ($validator->fails()) {
                return redirect('/admin/setting')
                    ->withErrors($validator, 'setting')
                    ->withInput();
            }


            DB::table('admins')->where('id', $id)->update(
                [
                    'name' => $name,
                    'email' => $email,
                ]
            );

            return redirect('/admin')
                ->with('message' , 'Changed your information');
        }
    }

    //Student Manage
    public function students()
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }
        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $dataAll = DB::table('users')->get();

        return view('admin.students', compact(['data' , 'dataAll']));
    }

    public function studentsAdd()
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        return view('admin.studentsAdd', compact('data' ));
    }

    public function studentsAddPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'stuid' => 'required|min:3|unique:users',
            'year' => 'required|min:4',
            'field' => 'required|min:4',
            'nationalId' => 'required|min:4',
            'password' => 'required|min:6',
            'repassword' => 'required|min:6|same:password',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/students/add')
                ->withErrors($validator, 'students')
                ->withInput();
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $stuid = $request->input('stuid');
        $year = $request->input('year');
        $field = $request->input('field');
        $nationalId = $request->input('nationalId');
        $password = $request->input('password');
        $image= $request->file('image');
        $dec = $request->input('desc');

        if($image)
        {
            $logo_filename = $image->getClientOriginalName();
            $image->move(public_path('uploads/img'), $stuid.$logo_filename);
        }
        else
        {
            $logo_filename = 'noimage.jpg';
        }

        DB::table('users')->insert(
            [
                'name' => $name,
                'email' => $email,
                'stuid' => $stuid,
                'year' => $year,
                'field' => $field,
                'nationalId' => $nationalId,
                'password' => encrypt($password),
                'img' => $stuid.$logo_filename,
                'desc' => $dec
            ]
        );

        return redirect('/admin/students')
            ->with('message', 'Student added');
    }

    public function studentsEdit($idS)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $dataAll = DB::table('users')->where('id',$idS)->first();

        return view('admin.studentsEdit', compact(['data', 'dataAll']));
    }

    public function studentsEditPost(Request $request)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'stuid' => 'required|min:3',
            'year' => 'required|min:4',
            'field' => 'required|min:4',
            'nationalId' => 'required|min:4',
            'password' => 'min:6',
            'repassword' => 'min:6|same:password',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/students/edit')
                ->withErrors($validator, 'students')
                ->withInput();
        }

        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $stuid = $request->input('stuid');
        $year = $request->input('year');
        $field = $request->input('field');
        $nationalId = $request->input('nationalId');
        $password = $request->input('password');
        $image= $request->file('image');
        $imgName = $request->input('imgName');
        $dec = $request->input('desc');

        if($password != "")
        {
            if($image)
            {
                File::delete('uploads/img'.$imgName);
                $logo_filename = $image->getClientOriginalName();
                $image->move(public_path('uploads/img'), $stuid.$logo_filename);

                DB::table('users')->where('id',$id)->update(
                    [
                        'name' => $name,
                        'email' => $email,
                        'stuid' => $stuid,
                        'year' => $year,
                        'field' => $field,
                        'nationalId' => $nationalId,
                        'password' => encrypt($password),
                        'img' => $stuid.$logo_filename,
                        'desc' => $dec
                    ]
                );
            }
            else
            {
                DB::table('users')->where('id',$id)->update(
                    [
                        'name' => $name,
                        'email' => $email,
                        'stuid' => $stuid,
                        'year' => $year,
                        'field' => $field,
                        'nationalId' => $nationalId,
                        'password' => encrypt($password),
                        'desc' => $dec
                    ]
                );
            }
        }
       else
       {
           if($image)
           {
               File::delete('uploads/img'.$imgName);
               $logo_filename = $image->getClientOriginalName();
               $image->move(public_path('uploads/img'), $stuid.$logo_filename);

               DB::table('users')->where('id',$id)->update(
                   [
                       'name' => $name,
                       'email' => $email,
                       'stuid' => $stuid,
                       'year' => $year,
                       'field' => $field,
                       'nationalId' => $nationalId,
                       'img' => $stuid.$logo_filename,
                       'desc' => $dec
                   ]
               );
           }
           else
           {
               DB::table('users')->where('id',$id)->update(
                   [
                       'name' => $name,
                       'email' => $email,
                       'stuid' => $stuid,
                       'year' => $year,
                       'field' => $field,
                       'nationalId' => $nationalId,
                       'desc' => $dec
                   ]
               );
           }
       }

        return redirect('/admin/students')
            ->with('message', 'Student edited');
    }

    public function studentsDelete($idS)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $dataAll = DB::table('users')->where('id',$idS)->first();

        return view('admin.studentsDelete', compact(['data', 'dataAll']));
    }

    public function studentsDeletePost(Request $request)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $idS = $request->input('id');
        $imgName = $request->input('imgName');

        File::delete('uploads/img/'.$imgName);

        DB::table('users')->where('id',$idS)->delete();

        return redirect('admin/students')
            ->with('message', 'Student deleted');
    }

    //User Manage
    public function users()
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }
        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $dataAll = DB::table('admins')->get();

        return view('admin.users', compact(['data' , 'dataAll']));
    }

    public function usersAdd()
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        return view('admin.usersAdd', compact('data' ));
    }

    public function usersAddPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6',
            'repassword' => 'required|min:6|same:password',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/users/add')
                ->withErrors($validator, 'users')
                ->withInput();
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');



        DB::table('admins')->insert(
            [
                'name' => $name,
                'email' => $email,
                'password' => encrypt($password),
            ]
        );

        return redirect('/admin/users')
            ->with('message', 'User added');
    }

    public function usersEdit($idA)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $dataAll = DB::table('admins')->where('id',$idA)->first();

        return view('admin.usersEdit', compact(['data', 'dataAll']));
    }

    public function usersEditPost(Request $request)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'password' => 'min:6',
            'repassword' => 'min:6|same:password',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/users/edit')
                ->withErrors($validator, 'users')
                ->withInput();
        }

        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        if($password != "")
        {
                DB::table('admins')->where('id',$id)->update(
                    [
                        'name' => $name,
                        'email' => $email,
                        'password' => encrypt($password),
                    ]
                );
        }
        else
        {
                DB::table('admins')->where('id',$id)->update(
                    [
                        'name' => $name,
                        'email' => $email,
                    ]
                );
        }

        return redirect('/admin/users')
            ->with('message', 'User edited');
    }

    public function usersDelete($idS)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $dataAll = DB::table('admins')->where('id',$idS)->first();

        return view('admin.usersDelete', compact(['data', 'dataAll']));
    }

    public function usersDeletePost(Request $request)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $idS = $request->input('id');

        DB::table('admins')->where('id',$idS)->delete();

        return redirect('admin/users')
            ->with('message', 'User deleted');
    }

    //Election Manage
    public function electionsAdd()
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        return view('admin.electionsAdd', compact('data' ));
    }

    public function electionsAddPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
            'count' => 'required|max:255',
            'count2' => 'required',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date',
            'limitType' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/election/add')
                ->withErrors($validator, 'elections')
                ->withInput();
        }

        $name = $request->input('name');
        $count = $request->input('count');
        $count2 = $request->input('count2');
        $dateStart = $request->input('dateStart');
        $dateEnd = $request->input('dateEnd');
        $limitType = $request->input('limitType');
        $description = $request->input('description');
        $img = $request->file('image');

        if($img)
        {
            $logo_filename = $img->getClientOriginalName();
            $img->move(public_path('uploads/img'), $dateStart.$logo_filename);
        }
        else
        {
            $logo_filename = 'noimage.jpg';
        }

        DB::table('elections')->insert(
            [
                'name' => $name,
                'countChoice' =>  $count,
                'countChoice2' => $count2,
                'dateStart' => $dateStart,
                'dateEnd' => $dateEnd,
                'limitType' => $limitType,
                'description' => $description,
                'logo' =>  $dateStart.$logo_filename
            ]
        );

        return redirect('/admin')
            ->with('message', 'Election added');
    }

    public function electionsEdit($idA)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $dataAll = DB::table('elections')->where('id',$idA)->first();

        return view('admin.electionsEdit', compact(['data', 'dataAll']));
    }

    public function electionsEditPost(Request $request)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
            'count' => 'required|max:255',
            'count2' => 'required',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date',
            'limitType' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/election/edit')
                ->withErrors($validator, 'elections')
                ->withInput();
        }

        $id = $request->input('id');
        $name = $request->input('name');
        $count = $request->input('count');
        $count2 = $request->input('count2');
        $dateStart = $request->input('dateStart');
        $dateEnd = $request->input('dateEnd');
        $limitType = $request->input('limitType');
        $description = $request->input('description');
        $img = $request->file('image');
        $imgName = $request->input('imgName');

        if($img)
        {
            File::delete('uploads/img'.$imgName);
            $logo_filename = $img->getClientOriginalName();
            $img->move(public_path('uploads/img'), $dateStart.$logo_filename);

            DB::table('elections')->where('id',$id)->update(
                [
                    'name' => $name,
                    'countChoice' =>  $count,
                    'countChoice2' => $count2,
                    'dateStart' => $dateStart,
                    'dateEnd' => $dateEnd,
                    'limitType' => $limitType,
                    'description' => $description,
                    'logo' =>  $dateStart.$logo_filename
                ]
            );
        }
        else
        {
            DB::table('elections')->where('id',$id)->update(
                [
                    'name' => $name,
                    'countChoice' =>  $count,
                    'countChoice2' => $count2,
                    'dateStart' => $dateStart,
                    'dateEnd' => $dateEnd,
                    'limitType' => $limitType,
                    'description' => $description,
                ]
            );
        }

        return redirect('/admin')
            ->with('message', 'Election edited');
    }

    public function electionsDelete($idS)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $dataAll = DB::table('elections')->where('id',$idS)->first();

        return view('admin.electionsDelete', compact(['data', 'dataAll']));
    }

    public function electionsDeletePost(Request $request)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $idS = $request->input('id');
        $img = $request->input('imgName');

        File::delete('uploads/img/'.$img);
        DB::table('elections')->where('id',$idS)->delete();

        return redirect('admin')
            ->with('message', 'Election deleted');
    }

    public function electionsAddpeople($idE)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $dataAll = DB::table('melections')->where('election_id',$idE)->get();

        $count = 0;

        $studentAll = null;

        foreach ($dataAll as $student)
        {
                $studentAll[$count] = DB::table('users')->where('stuId', $student->stuid)->first();
                ++$count;
        }


        return view('admin.electionsAddpeople', compact(['data', 'studentAll', 'idE']));
    }

    public function electionsAddpeoplePost(Request $request)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();

        $idE = $request->input('id');
        $stuId = $request->input('stuId');

        DB::table('melections')->insert(
            [
                'stuid' => $stuId,
                'election_id' => $idE
            ]
        );

        return redirect('admin/election/addpeople/'.$idE)
            ->with('message', 'People added');
    }

    public function electionsDeletepeoplePost($idE,$idS)
    {
        if(!(\Session::has('admin')))
        {
            return redirect('admin/login');
        }

        $id = \Session::get('admin');

        $data = DB::table('admins')->where('id',$id)->first();


        DB::table('melections')->where(['election_id' => $idE , 'stuid' => $idS])->delete();

        return redirect('/admin/election/addpeople/'.$idE)
            ->with('message', 'People deleted');
    }
}
