<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
use App\User;
use App\Category;
use App\Choices;
use App\Answer;
use App\Lesson;
use App\Activity;
use App\Follower;
use Input;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('check', ['only' => ['followUser','unFollowUser']]);
    }

    public function displayList()
    {
        $users = User::all();

        return view('users.DispUsers',compact('users'));
    }

    public function show(User $userId)
    {
        $followers = $userId->followers;
        $followings = $userId->followings;
    }

    public function displayProfile(User $userId)
    {
        return view('users.DispProf',compact('userId')); 
    }

    public function followUser(User $profileId)
    {
        $currentUser = Auth::user();

        $profileId->followers()->attach($currentUser->id);
        return redirect()->back()->with('success', 'Successfully followed the user.');
    }

    public function unFollowUser(User $profileId)
    {
        $profileId->followers()->detach(auth()->user()->id);
        return redirect()->back()->with('success', 'Successfully unfollowed the user.');
    }

    public function showCategories()
    {
        $categories = Category::all();

        return view('users.Lesson',compact('categories'));
    }

    public function makeLesson($categoryId)
    {
        $user = auth()->user();

        $lesson =Lesson::create([
            'category_id' => $categoryId,
            'user_id' => $user->id,
        ]);

        $lessonId=$lesson->id;

        return redirect()->action('UserController@showQuiz',compact('categoryId','lessonId'));
    }

    public function showQuiz($categoryId,$lessonId)
    {
        $currentUserId = auth()->user()->id;

        $categoryId=(int)$categoryId;

        $questions = Question::where('category_id', $categoryId)->paginate(1);
        $currentPage = $questions->currentPage();

        return view('users.Quiz',compact('questions','categoryId','lessonId','currentPage'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $lessonId = (int)$request->get('lessonId');
        $var1 = Question::where('category_id','=',$request->categoryId)->get();
        $categoryId= $request->categoryId;

        (new Answer)->createAnswer(([
            'choice_id' => (int)$request->choices,
            'question_id' =>(int)$request->get('id'),
            'lesson_id' => (int)$request->get('lessonId'),
        ]));

        if((int)$request->get('currentPage')== $var1->count()){
            return redirect()->action('UserController@createActivity',compact('categoryId','lessonId','lessonId'));
        }
        else{
            return redirect($request->get('nextPage'));
        }
    }

    public function createActivity()
    {
        $user = auth()->user();
        Activity::create([
            'action_id'=> $lessonId,
            'action_type'=>"App\Lesson",
            'user_id'=> $user->id
        ]);

        return redirect()->action('UserController@check',compact('categoryId','lessonId'));
    }
}
