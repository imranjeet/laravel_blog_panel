@extends('layout')
@section('dashboard-content')
    <h1> Create blog post</h1>

    @if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('success') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::get('failed'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('failed') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ URL::to('store-blog-post') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1"> Blog title </label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter blog title" name="blogTitle">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1"> Blog details </label>
            <textarea class="form-control" id="editor1" name="blogDetails"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1"> Select category </label>
            <select class="form-control" name="category">
                <option> Select </option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label> Select featured photo </label>
            <input type="file" name="featuredPhoto" class="form-control" onchange="loadPhoto(event)">
        </div>

        <div>
            <img id="photo" height="100" width="100">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        function loadPhoto(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('photo');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

@stop
