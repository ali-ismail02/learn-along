<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserType;
use App\Models\Course;
use App\Models\Enroll;
use Auth;
use Validator;

class AdminController extends Controller
{

    // Adding/Deleting users functions-------------------------------------------------------------------------

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

        $type_id = UserType::where('type',$request['type'])->first();
        
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
            "user_type"=> $type_id['_id'],
            'created_at' => time()
        ]);
        file_put_contents($file, $data);
        return response()->json([
            "status" => "1",
            "message" => "Registered"
        ]);
    }

    public function deleteUser(Request $request){
        $user = User::where('_id',$request['id'])->where('user_type',"!=",1)->first(); 
        if($user){
            $user->delete();
            return response()->json([
                "status" => "1",
                "message" => "Deleted!"
            ]);
        }
        return response()->json([
            "status" => "0",
            "message" => "User does not exist!"
        ]);
    }

    // getting/searching users functions-------------------------------------------------------------------------


    public function getInstructors(Request $request){
        $user = User::where('user_type',2)->get();
        return response()->json([
            "status" => "0",
            "message" => $user
        ]);
    }

    public function searchInstructors(Request $request){
        if(!$request['search']) return $this->getInstructors($request);
        
        $user = User::where('user_type',2)->where('name', 'like', '%' . $request['search'] . '%')->get();
        return response()->json([
            "status" => "0",
            "message" => $user
        ]);
    }
 
    public function getStudents(Request $request){
        $user = User::where('user_type',3)->get();
        return response()->json([
            "status" => "0",
            "message" => $user
        ]);
    }

    public function searchStudents(Request $request){

        if(!$request['search']) return $this->getStudents($request);

        $user = User::where('user_type',3)->where('name', 'like', '%' . $request['search'] . '%')->get();
        return response()->json([
            "status" => "0",
            "message" => $user
        ]);
    }

    // Courses related functions-------------------------------------------------------------------------

    public function addCourse(Request $request){
        
        if(count(Course::where('name',$request['name'])->get())){
            return response()->json([
                "status" => "0",
                "message" => "Course already exists!"
            ]);
        }

        if(!count(User::where('_id',$request['instructor_id'])->where('user_type',2)->get())){
            return response()->json([
                "status" => "0",
                "message" => "Instructor does not exist!"
            ]);
        }

        Course::create([
            'name' => $request['name'],
            'instructor_id' => null,
            'created_at' => time()
        ]);
        return response()->json([
            "status" => "1",
            "message" => "Added"
        ]);
    }

    public function getCourses(Request $request){
        $course = Course::all();
        return response()->json([
            "status" => "0",
            "message" => $course
        ]);
    }

    public function searchCourses(Request $request){

        if(!$request['search']) return $this->getCourses($request);

        $course = Course::where('name', 'like', '%' . $request['search'] . '%')->get();
        return response()->json([
            "status" => "0",
            "message" => $course
        ]);
    }

    public function deleteCourse(Request $request){
        $course = Course::where('name',$request['name'])->first(); 
        if($course){
            $course->delete();
            return response()->json([
                "status" => "1",
                "message" => "Deleted!"
            ]);
        }
        return response()->json([
            "status" => "0",
            "message" => "Course does not exist!"
        ]);
    }
    
    // Assigning/Unassigning intructors functions-------------------------------------------------------------------------

    public function assign(Request $request){
        $course = Course::where('_id',$request['course_id'])->first();
        if(!$course){
            return response()->json([
                "status" => "0",
                "message" => "Course does not exist!"
            ]);
        }

        if(!count(User::where('_id',$request['instructor_id'])->where('user_type',2)->get())){
            return response()->json([
                "status" => "0",
                "message" => "Instructor does not exist!"
            ]);
        }

        $course->update(['instructor_id' => $request['instructor_id']]);
        return response()->json([
            "status" => "1",
            "message" => "Assigned"
        ]);
    }

    public function unAssign(Request $request){
        $course = Course::where('_id',$request['course_id'])->first();
        if(!$course){
            return response()->json([
                "status" => "0",
                "message" => "Course does not exist!"
            ]);
        }
        $course->update(['instructor_id' => null]);
        return response()->json([
            "status" => "1",
            "message" => "Unassigned"
        ]);
    }

    // Enrolling/Unenrolling students functions-------------------------------------------------------------------------

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
