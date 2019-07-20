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

    public function userProfile()
    {
        $flag= null;
        $allActivities = collect();
 
        $user = Auth()->user();
        $userActivities = $user->activity;

        foreach($userActivities as $userActivity){
 
            $allActivities->push($userActivity);
        }

        $name = $user->name;
        $id = $user->id;

        $wordsLearned = 0;
        $currentUserId = auth()->user()->id;
        $results= Result::where('user_id','=',$currentUserId )->get();

        for($i=0;$i<$results->count();$i++){
            $wordsLearned = $wordsLearned+ $results[$i]->score;
        }
        
        return view('users.Profile',compact('user','name','flag','wordsLearned','allActivities')); 
    
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
        $flag=Lesson::where('user_id','=',$user->id)->where('category_id','=',$categoryId)->first();

        if($flag){

            return redirect()->action('UserController@showCategories');
        }
        else{
            $lesson =Lesson::create([
                'category_id' => $categoryId,
                'user_id' => $user->id,
            ]);
    
            $lessonId=$lesson->id;
            
            return redirect()->action('UserController@showQuiz',compact('categoryId','lessonId'));
        }
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

        $title = Category::find($categoryId )->title;

        $score=0;
        $userId = auth()->user()->id;
        $answers = Answer::where('lesson_id','=',$lessonId)->get();
     
        $question = Question::where('category_id','=',$categoryId)->get();

        $choices = Choices::where('question_id','=',(int)$request->get('id'));

        for($i=0;$i<$question->count();$i++){
            $choiceId= $answers[$i]->choice_id;
            $isCorrect = Choices::find($choiceId)->isCorrect;
            if($isCorrect==1){
                $score=$score+1;
            }
        }
        
        $collection = collect();

        for($j=0;$j<$question->count();$j++){
            $collection->push($question[$j]->term);
        }
        
        $collection1 = collect();
        $answer= Answer::where('lesson_id','=',$lessonId)->get();
        for($k=0;$k<$question->count();$k++){
            $choice = Choices::where('id','=',(int)$answer[$k]->choice_id)->first();
            $collection1->push($choice);
        }
        
        return view('users.check',compact('title','score','question','answers','choices','collection','collection1','categoryId','lessonId'));
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

        $answerCollection = collect();
        for($i=0;$i<$answers->count();$i++){
            $answerCollection->push($answers[$i]->choice_id);
        }

        $correctAnswers = collect();
        $questionCollection = collect();
        $answerCount=$answerCollection->count();

        for($j=0;$j<$answerCount;$j++){
            $choice = Choices::find($answerCollection[$j]);
            if($choice->isCorrect==1){
                $correctAnswers->push($choice->word);
                $questionCollection->push($choice->question);
            }
        }
        return view('users.DispWords',compact('name','correctAnswers','questionCollection','wordsLearned'));
    }

    public function viewProfile(User $userId)
    {
        
        $allActivities = collect();
        $userActivities = $userId->activity;

        foreach($userActivities as $userActivity){
 
            $allActivities->push($userActivity);
        }

        $user = $userId;

        $name = $userId->name;
        $id = auth()->user()->id;

        $wordsLearned = 0;
        $currentUserId = auth()->user()->id;
        $results= Result::where('user_id','=',$user->id )->get();
        for($i=0;$i<$results->count();$i++){
            $wordsLearned = $wordsLearned+ $results[$i]->score;
        }
        $flag = Follower::where('follower_id','=',$currentUserId)->where('leader_id','=',$userId->id)->first();
        
        return view('users.Profile',compact('user','name','wordsLearned','flag','allActivities')); 
    }

    public function showFollow(){
        $user = auth()->user();

        $followers = $user->followers;
        return view('users.followDisplay', compact('followers')); 
    }

    public function showFollowing(){
        $user = auth()->user();

        $followings = $user->followings;
        return view('users.followingDisplay', compact('followings')); 
    }
}
