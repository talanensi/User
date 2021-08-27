<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\DB; 

class UserController extends Controller
{
    public function index(UserDataTable $userdatatable)
    {
        return $userdatatable->render('admin.user.index');
    } 

    public function view()
    {
        $countries = Country::all();
        return view('admin.user.create',compact('countries'));
    }

    public function country()
    {
        $data['countries'] = Country::get(["country_name","id"]);
        return view('admin.user.country-state-city',$data);
    }

    public function getState(Request $request)
    {
        $data['state'] = State::where("country_id",$request->country_id)
                    ->get(["state_name","id"]);
        return response()->json($data);
    }
    
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)
                    ->get(["city_name","id"]);
        return response()->json($data);
    }

    public function check(Request $request){
        if($request->get('email'))
        {
            $email = $request->get('email');
            $data = DB::table("user")->where('email',$email)->count();
            if($data > 0)
            {
                return 'Not_Unique';
            }
            else
            {
                return 'Unique';
            }
        }
    }

    public function checkk(Request $request){
        if($request->get('mobile'))
        {
            $mobile = $request->get('mobile');
            $data = DB::table("user")->where('mobile',$mobile)->count();
            if($data > 0)
            {
                return 'Not_Unique';
            }
            else
            {
                return 'Unique';
            }
        }
    }

    public function store(AddUserRequest $request)
    {

        $image = uploadFile($request->image,'image');
        
        $user = Users::create([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'password'=>Hash::make($request->password),
            'image'=>$image,
            'country'=>$request->country,
            'state'=>$request->state,
            'city'=>$request->city,
        ]);

        if($user)
        {
            $response['status'] = 'success';
            $response['message'] = 'recored created successfully';
        }
        else
        {
            $response['status'] = 'danger';
            $response['message'] = 'Something went wrong! Try again later...';
        }

        return $response;
    }

    public function test1($id)
    {
        $edit = Users::find($id);
        $countries = Country::all();
        $states = State::all();
        $citys = City::all();
        return view('admin.user.edit',compact('edit','countries','states','citys'));

    }

    public function update(UpdateUserRequest $request)
    {
        // dd($request->all());
        // $image = uploadFile($request->image,'image');
        if(isset($request->image)){

            $image = uploadFile($request->image,'image');
 
        $category = Users::where('id',$request->user_id)->update([
                                        'fname'=>$request->fname,
                                        'lname'=>$request->lname,
                                        'gender'=>$request->gender,
                                        'dob'=>$request->dob,
                                        'email'=>$request->email,
                                        'mobile'=>$request->mobile,                                     
                                        'image'=>$image,
                                        'country'=>$request->country,
                                        'state'=>$request->state,
                                        'city'=>$request->city,
                                        ]);
                                    }else{
                                        $category = Users::where('id',$request->user_id)->update([
                                            'fname'=>$request->fname,
                                            'lname'=>$request->lname,
                                            'gender'=>$request->gender,
                                            'dob'=>$request->dob,
                                            'email'=>$request->email,
                                            'mobile'=>$request->mobile,                                     
                                            // 'image'=>$image,
                                            'country'=>$request->country,
                                            'state'=>$request->state,
                                            'city'=>$request->city,
                                            ]);
                                        }
        
        if($category)
        {
            $response['status'] = 'success';
            $response['message'] = 'recored updated successfully';
        }
        else
        {
            $response['status'] = 'danger';
            $response['message'] = 'Something went wrong! Try again later...';
        }

        return $response;
    
    }
}
