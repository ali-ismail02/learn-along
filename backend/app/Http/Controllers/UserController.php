<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserType;
use Auth;
use Validator;

class UserController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'Email'=>'required|string|email'
        ]);


        if(!$validator){
            return response()->json([
                "status" => "0",
                "message" => $validator
            ]);
        }
        
        if(count(User::where('email',$request['email'])->get())){
            return response()->json([
                "status" => "0",
                "message" => "Email taken!"
            ]);
        }
        
        $img = $request['image'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $filee = uniqid() . '.png';
        $file = public_path('images')."\\".$filee;
        $images_to_save = "/backend/public/images/".$filee;
        $dob = $request['dob'];
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request->password),
            'gender' => $request['gender'],
            'image' =>  $images_to_save,
            'dob' => $dob,
            "user_type"=>$request['type'],
            'created_at' => time()
        ]);
        file_put_contents($file, $data);
        return response()->json([
            "status" => "1",
            "message" => "Registered"
        ]);
    }

}
