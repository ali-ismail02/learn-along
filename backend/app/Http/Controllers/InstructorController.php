<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserType;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Assignment;
use App\Models\Announcment;
use App\Models\StudentAnnouncment;
use Auth;
use Validator;

class InstructorController extends Controller
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
            "user_type"=> 3,
            'created_at' => time()
        ]);
        file_put_contents($file, $data);
        return response()->json([
            "status" => "1",
            "message" => "Registered"
        ]);
    }

    public function enrollStudent(Request $request){
        
        if(!count(Course::where('_id',$request['course_id'])->get())){
            return response()->json([
                "status" => "0",
                "message" => "Course does not exist!"
            ]);
        }

        if(!count(User::where('_id',$request['student_id'])->where('user_type',3)->get())){
            return response()->json([
                "status" => "0",
                "message" => "Student does not exist!"
            ]);
        }

        Enroll::create([
            'student_id' => $request['student_id'],
            'course_id' => $request['course_id'],
            'created_at' => time()
        ]);
        return response()->json([
            "status" => "1",
            "message" => "Enrolled"
        ]);
    }

    public function unEnrollStudent(Request $request){
        $enroll = Enroll::where('course_id',$request['course_id'])->where('student_id',$request['student_id'])->first();

        if(!$enroll){
            return response()->json([
                "status" => "0",
                "message" => "Enrollment does not exist!"
            ]);
        }

        $enroll->delete();
        return response()->json([
            "status" => "1",
            "message" => "deleted"
        ]);
    }
}
