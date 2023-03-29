@extends('layouts.app')
@section('content')
    <main class="container">
        <section>
            <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data" >
                @csrf
                <div class="titlebar">
                    <h1>Add Blog</h1>
                </div>
                <div class="card">
                    <div>
                        <label>Title</label>
                        <input type="text" name="title" >
                        <label>Content</label>
                        <textarea cols="10" rows="5" name="content"></textarea>
                        <label>Add Image</label>
                        <img src="" alt="" class="img-product" id="file-preview" />
                        <input type="file"  name="image" accept="image/*" onchange="showFile(event)">
                        <label>Category</label>
                        <select name="category" >
                            @foreach(json_decode('{"Education":"Education","Technology":"Technology","Sport":"Sport","Cryptocurrency":"Cryptocurrency"}', true) as $optionKey => $optionValue)
                                <option value="{{$optionKey}}" >{{$optionValue}}</option>
                            @endforeach
                        </select>
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
