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
use App\Result;
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

        return view('users.dispUsers',compact('users'));
    }

    public function show(User $userId)
    {
        $followers = $userId->followers;
        $followings = $userId->followings;
    }

    public function displayProfile(User $userId)
    {
        return view('users.dispProf',compact('userId')); 
    }

    public function followUser(User $profileId)
    {
        $currentUser = Auth::user();
        $profileId->followers()->attach($currentUser->id);

        (new Activity)->createActivityFollower();
  
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

        return view('users.lesson',compact('categories'));
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
        return view('users.quiz',compact('questions','categoryId','lessonId','currentPage'));
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
            return redirect()->action('UserController@check',compact('categoryId','lessonId'));
        }
        else{
            return redirect($request->get('nextPage'));
        }
    }

    public function check(Request $request)
    {
        $lessonId = (int)$request->get('lessonId');
        $categoryId = (int)$request->get('categoryId');

        $score=0;
        $userId = auth()->user()->id;
        $answers = Answer::where('lesson_id','=',$lessonId)->get();

        $questions = Question::where('category_id','=',$categoryId)->get();

        $choices = Choices::where('question_id','=',(int)$request->get('id'));

        for($i=0;$i<$questions->count();$i++){
            $choiceId= $answers[$i]->choice_id;
            $isCorrect = Choices::find($choiceId)->isCorrect;
            if($isCorrect==1){
                $score=$score+1;
            }
        }

        $collection = (new Question)->getQuestions($categoryId);

        $collection1 = (new Answer)->getAnswers($lessonId);
        
        return view('users.check',compact('score','questions','answers','choices','collection','collection1','categoryId','lessonId'));
    }

    public function wordsLearned()
    {
        $userId = auth()->user()->id;
        $name = auth()->user()->name;
        $answers = User::find($userId)->answer()->get();

        $wordsLearned = 0;
        $currentUserId = auth()->user()->id;
        $results= Result::where('user_id','=',$currentUserId)->get();

        for($i=0;$i<$results->count();$i++){
            $wordsLearned = $wordsLearned+ $results[$i]->score;
        }

        $answerObject = new Answer;

        $answerCollection = $answerObject->getAnswerId($answers);

        $correctAnswers = $answerObject->getCorrectAnswers($answerCollection);

        $questionCollection =  $answerObject->getQuestions($answerCollection);
        
        return view('users.dispWords',compact('name','correctAnswers','questionCollection','wordsLearned'));
    }
}
