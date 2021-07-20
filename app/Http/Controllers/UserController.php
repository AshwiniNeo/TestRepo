<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Auth;
use App\Repository\User\userListInterface;

class UserController extends Controller
{

    private $user;

    private $attribute = array();

    public function __construct(userListInterface $user){
        $this->user = $user;
    }

    public function index(){
        $users = $this->user->getAll();
        return view('user_dashboard.user.index',['users' => $users]);
    }

    public function addUser(Request $request){
        if ($request->isMethod('post')) {
            $rules = array(
                'name' => 'bail|required|alpha',
                'email' => 'bail|required|unique:users,email',
            );
            $messages = array(
                'name.required' => 'Name is required.',
                'name.alpha' => 'Name must be alphabet',
                'email.required' => 'Email is required.',
                'email.unique' => 'This email already exist'
            );
            $this->validate($request,$rules,$messages);
            $attributes = $request->only(['name', 'email','password']);
            $data = $this->user->store($attributes);
            // $data = $this->companyAdminRepository->update(base64_decode($attributes['id']), $attributes);
            if($data['status'] == TRUE) {
                return redirect('/user-list')->with('message','Data added Successfully');
            } else {
                return back()->with('error','Error while saving');
            }
        }
        return view('user_dashboard.user.add');
    }

    public function editUser(Request $request,$id=null){
        if($id != null){
            $id = base64_decode($id);
            $user = $this->user->find($id);
            return view('user_dashboard.user.edit',['user' => $user]);
        }
    }

    public function UpdateUser(Request $request,$id=null){
        $id = base64_decode($id);
        $rules = array(
            'name' => 'bail|required|alpha',
            'email' => 'bail|required|unique:users,email,'. $id .',id',
        );
        $messages = array(
            'name.required' => 'Name is required.',
            'name.alpha' => 'Name must be alphabet',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email already exist'
        );
        $this->validate($request,$rules,$messages);
        if($id != null){ 
            $attributes = $request->only(['name','email','password']);
            $response = $this->user->update($attributes,$id);
            if($response['status'] == TRUE)
            {
                return redirect('/user-list')->with('message','Data updated Successfully');
            }else{
                return back()->with('error','Error while updating');
            }
        }
    }

    public function deleteUser($id=null){
        if($id != null){ 
            $id = base64_decode($id);
            $response = $this->user->delete($id);
            if($response['status'] == TRUE)
            {
                return redirect('/user-list')->with('message','Data deleted Successfully');
            }else{
                return back()->with('error','Error while deleting');
            }
        }
    }

}
