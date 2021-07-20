<?php

namespace App\Repository\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Hash;
use Carbon\Carbon;

class userListRepo implements userListInterface
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function find($id){
        $user = DB::select('call GetUserById(?)',array($id));
        return $user[0];
        //return $this->user->findOrFail($id);
    }

    public function getAll(){
        $users = DB::select('call GetUsers');
        return $users;
        //return $this->user->all();
    }

    public function store($attributes){
        $response = array('status' => FALSE,'message' => 'Error while processing the request');
        try{
            $password = Hash::make($attributes['password']);
            $output = DB::select('call insertUser(?,?,?,?)',array($attributes['name'],$attributes['email'],Carbon::now(),$password));
            if($output == []){
                $response = array('status' => TRUE,'message' => 'Saved Successfully');
            }
        }catch (\Exception $e) {
            //DB::rollBack();
            $response = array('status' => FALSE,'message' => "Error while processing the request");
        }
        return $response;
    }

    public function update($attributes,$id){
        $response = array('status' => FALSE,'message' => 'Error while processing the request');
        //DB::beginTransaction();
        // try{
        //     $user = User::find($id);
        //     $user->name = $attributes['name'];
        //     $user->email = $attributes['email'];
        //     if(isset($attributes['password']))
        //         $user->password = Hash::make($attributes['password']);
        //     if($user->save()){
        //         //DB::commit();
        //         $response = array('status' => TRUE,'message' => 'Updated Successfully');
        //     }
        // }catch (\Exception $e) {
        //     //DB::rollBack();
        //     $response = array('status' => FALSE,'message' => "Error while processing the request");
        // }

        try{
            $password = Hash::make($attributes['password']);
            $output = DB::select('call updateUser(?,?,?,?,?)',array($attributes['name'],$attributes['email'],Carbon::now(),$password,$id));
            if($output == []){
                $response = array('status' => TRUE,'message' => 'Updated Successfully');
            }
        }catch (\Exception $e) {
            //DB::rollBack();
            $response = array('status' => FALSE,'message' => "Error while processing the request");
        }
        return $response;
    }

    public function delete($id){
        $response = array('status' => FALSE,'message' => 'Error while processing the request');
        try{
            $output = DB::select('call deleteUser(?)',array($id));
            if($output == []){
                $response = array('status' => TRUE,'message' => 'Deleted Successfully');
            }
            // $user = User::find($id);
            // if($user->delete()){
            //     DB::commit();
            //     $response = array('status' => TRUE,'message' => 'Updated Successfully');
            // }
        }catch (\Exception $e) {
            DB::rollBack();
            $response = array('status' => FALSE,'message' => "Error while processing the request");
        }
        return $response;
    }
}