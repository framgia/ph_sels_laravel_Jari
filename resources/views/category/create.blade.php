<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <h1>Create a new category</h1>


    <form method="POST" action="/category/store">

        {{ csrf_field() }}
        <div class ="field">
            <label class="label" for="title" >Category Title</label>
            
            <input type= "text" name="title" placeholder="Category Title" value="{{old('title')}}" >
        </div>

        <div class="field">
            <label name="label" for="description" >Category Description</label>
                <textarea name ="description" placeholder="Category description" ></textarea>
        </div>
        

        <div>
            <button type="submit">Create Category</button>
        </div>


        <!-- @if ($errors->any())
        <div class= "notification is-danger">
        
            <ul>

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        
        </div>
        @endif -->

    </form>


</body>
</html>