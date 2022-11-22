<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class RelationController extends Controller
{
    public function one_to_one() {

//        $user = Auth::user();
//        $profile = Profile::where('user_id', $user)->first();
//        return $user->profile;

//        $profile = Profile::find(1);
//        dd($profile->user);

        $users = User::with('profile')->get();

        $user = User::find(19);

        $user->profile()->create([
            'image' => 'dd.png',
            'date_of_birth' => '2022-12-11',
            'facebook' => 'test.facebook.com',
            'user_id' => $user->id,
        ]);

//        Profile::create([
//            'image' => 'image14.png',
//            'date_of_birth' => '2023-11-20',
//            'facebook' => '14email.facebook.com',
//            'user_id' => $user->id,
//        ]);

        return view('admin.one_to_one', [
            'users' => $users,
        ]);

    }

    //  المكان الي فيه foreignId فيه belong

    public function one_to_many() {

       $post = Post::with('comments.user')->withCount('comments')->find(1);

//       $comment = Comment::find(1);

//        return $post;

        return view('admin.one_to_many', [
            'post' => $post,
        ]);

    }


    public function add_comment(Request $request) {

        $userId = Auth::id();

        $comment =  Comment::create([
            'post_id' => $request->post_id,
            'user_id' =>  $userId,
            'content' => $request->content,
        ]);

        $comment->load('user');

        return $comment;

    }


    public function many_to_many() {

        $std = Student::find(2);

        $courses = Course::all();

        $course = Course::find(2);

//        dd($course->students);

        return view('admin.many_to_many', compact('std', 'courses'));
    }

    public function many_to_many_data(Request $request) {

//        dd($request->all());

        $std = Student::find(2);

        // DB::table('course_student')->insert([])

        $data = $request->marks;

        foreach($data as $id => $mark){
            if(is_null($mark['mark'])) {
                unset($data[$id]);
            }
        }
        dd($data);

        // attach => just add
        // $std->courses()->attach($request->courses);
        // $std->courses()->detach($request->courses);
        $std->courses()->sync($request->courses);

        return redirect()->back();


    }

}
