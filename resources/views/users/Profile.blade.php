@extends('layouts.app')
@section('content')
@if(\Session::has('error'))
<div class='alert alert-danger'>
    {{\Session::get('error')}}
</div>
@endif
<div class='container'>

    <div class='row'>
        
        <div class='panel panel-default'>
            <div class='panel-heading'>Dashboard</div>

        </div>
    </div>
        <div class='row'>
            <div class='col-md-4 col-md-offset-4'>
                <div>{{$name}}</div>
                <div>Learned {{App\Lesson::where('user_id','=',auth()->user()->id)->get()->count()}} lessons</div>        
                <div>Learned {{$wordsLearned}} words</div>  
            </div>
                <div class='col-md-3 col-md-offset-9'>
                    @php

                        echo "<br>";
                        echo "Activities: ";
                        echo "<br>";

                        echo "<br>";

                        foreach($allActivities->take(6) as $activity){
                            
                            if($activity->action_type=='App\Follower'){
                                
                                echo $activity->user->name;
                                echo $activity->content;
                                echo "<br>";
                            }
                            else if($activity->action_type=='App\Lesson'){
                                
                                echo $activity->user->name . $activity->content;
                                echo "<br>";
                                
                            }
                        }
                    @endphp
                </div>
        </div>
        <div class='row'>

            <div class='..col-md-2 col-md-offset-2'>
                {{$user->followers()->count()}}<div>Followers</div>
            </div>
            <div class='.col-md-2 col-md-offset-8'>
                {{$user->followings()->count()}}<div>Following</div>
            </div>
       
           
        </div>
    </div>
</div>
@endsection