@extends('layouts.app')
@section('content')
    <main class="container">
        <section>
            <form method="post" action="{{route('blogs.update', $blog->id)}}" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                <div class="titlebar">
                    <h1>Edit Blog</h1>
                </div>
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>

                @endif
                <div class="card">
                    <div>
                        <label>Title</label>
                        <input type="text" name="title" value="{{$blog->title}}" >
                        <label>Description</label>
                        <textarea cols="10" rows="5" name="description" value="{{$blog->description}}">{{$blog->description}}</textarea>
                        <label>Add Image</label>
                        <img src="{{asset('images/' . $blog->image)}}" alt="" class="img-product" id="file-preview" />
                        <input type="hidden" name="hidden_blog_image" value="{{ $blog->image }}">
                        <input type="file"  name="image" accept="image/*" onchange="showFile(event)">
                        <label>Category</label>
                        <select name="category" >
                            @foreach(json_decode('{"Education":"Education","Technology":"Technology","Sport":"Sport","Cryptocurrency":"Cryptocurrency"}', true) as $optionKey => $optionValue)
                                <option value="{{$optionKey}}" {{ (isset($blog->category) && $blog->category == $optionKey) ? 'selected' : '' }}>{{$optionValue}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="hidden_id" value="{{$blog->id}}">
                        <button>Save</button>
                    </div>
                </div>
            </form>
        </section>
    </main>
    <script>
        function showFile(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function (){
                var dataURL = reader.result;
                var output = document.getElementById('file-preview');
                output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
