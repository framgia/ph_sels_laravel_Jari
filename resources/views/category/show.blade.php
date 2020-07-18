<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <h1>Categories</h1>

    <a href="/category/create">Create a category </a>
    <a href="/home">Home Button </a>
    

    @foreach ($categories as $category)


        <form method="POST" action= "/category/{{$category->id}}">
            @method('PATCH')
            @csrf

            <div>
            <label calss="label" for="title">Title</label>

                <div class="control">
                    <input type="text" class="input" name="title" placeholder="Title" value="{{ $category->title }}">
                </div>
            </div>

            <div class="field">
                <label class="label" for="description">Description</label>


                <div class="control">
                    <textarea name="description" class="textarea">{{ $category->description }}</textarea> <!--put placeholder-->
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-link btn btn-primary">Update Category</button>
                </div>
            </div>
        </form>

        <form method="POST" action= "/category/{{$category->id}}">

            @method('DELETE')
            @csrf
            <div class="field">
                <div class="control">
                <button type="submit" class="button is-link">Delete Category</button>
                </div>
            </div>
        </form>

    @endforeach



</body>
</html>