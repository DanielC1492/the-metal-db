<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registerUser(Request $request){
        $nickname = $request->input('nickname');
        $password = $request->input('password');
        $name = $request->input('name');
        $email = $request-> input('email');
        $country = $request-> input('country');

        $password = Hash::make($password);

     try{
         return [ 'Success'=>'Account created!!',User::create([
             'nickname' => $nickname,
             'password' => $password,
             'name' => $name,
             'email' => $email,
             'country'=>$country
         ])];
         } catch (QueryException $error){
         return $error;
        }
    }



    public function getUserById($id) {
        try {

            return User::all()->where('id', '=', $id)
            ->makeHidden(['password'])->keyBy('id');
       
        } catch (QueryException $error){
            return $error;
        }
    }

    public function getUserByNickname($nickname) {
        try {

            return User::all()->where('id', '=', $nickname)
            ->makeHidden(['password'])->keyBy('id');
       
        } catch (QueryException $error){
            return $error;
        }
    }

    public function getAllUsers() {
        try {

            return User::all()->makeHidden(['password','token']);
       
        } catch (QueryException $error){
            return $error;
        }
    }

    public function loginUser(Request $request){

        $email = $request->input('email');
        $password = $request->input('password'); 
        
        try {
             $validate = User::select('password')
            ->where('email', 'LIKE', $email)
            ->first();

            if(!$validate){
                return response()->json([
                'error' => "Email o password incorrecto"
                ]); 
            }
            
            $hashed = $validate->password;
            if(Hash::check($password, $hashed)){
              
                $token = bin2hex(random_bytes(50));
                User::where('email',$email)
                ->update(['token' => $token]);
                return ['Success'=>'Ya Estas Logueado' ,User::where('email', 'LIKE', $email)
                ->get(),];
            
            }else{
                return response()->json([
                   
                    'error' => "Email o password incorrecto"]);
            }
        } catch(QueryException $error){
            return response()->$error;
        }


    }


    public function updateUser(Request $request){
        
        $nickname = $request->input('nickname');
        $name = $request-> input('name');
        $country = $request-> input('country');
        
        $userId = $request->input('id');
        try{

        return [User:: where('id','=',$userId)->update(
            [
                'nickname' => $nickname,
                'name' =>$name,
                'country'=>$country
            ]),'Success'=>"Usuario Actualizado Con Exito"];
       }catch(QueryException $error){
        return $error;
     }
    }

    public function deleteUser(Request $request){

        $userId = $request->input('id');

        try{
              return ['Success'=>'Usuario borrado de la base de datos',User::where('id','=',$userId)->delete()];
   
        }catch(QueryException $error){
           return $error;
        }
       }

       public function logOut(Request $request){

        $id = $request->input('id');
        

        try {

            return [User::where('id', '=', $id)
            ->update(['token' => '']),'Success'=>'Todo Ok , Logout Con Exito'];

        } catch(QueryException $error){
            return $error;
        }

    }
    public function addMessage(Request $request){

           $userid=$request->input('userid');
        
    }



}