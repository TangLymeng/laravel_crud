@extends('layouts.app')

@section('content')
    <main class="container">
        <section>
            <div class="titlebar">
                <h1>Blogs</h1>
                <a href="{{route('blogs.create')}}" class="btn-link"> Add Blog </a>
            </div>
            @if($message = Session::get('success'))
                <div>
                    <script type="text/javascript">
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: '{{$message}}'
                        })
                    </script>
                </div>
            @endif
            <div class="table">
                <div class="table-filter">
                    <div>
                        <ul class="table-filter-list">
                            <li>
                                <p class="table-filter-link link-active">All</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="GET" action="{{ route('blogs.index') }}" accept-charset="UTF-8" role="search">
                    <div class="table-search">
                        <div>
                            <button class="search-select">
                                Search Blogs
                            </button>
                            <span class="search-select-arrow">
                                <i class="fas fa-caret-down"></i>
                            </span>
                        </div>
                        <div class="relative">
                            <input class="search-input" type="text" name="search" placeholder="Search blog..." value="{{ request('search') }}">
                        </div>
                    </div>
                </form>
                <div class="table-product-head">
                    <p>Id</p>
                    <p>Title</p>
                    <p>Description</p>
                    <p>Image</p>
                    <p>Category</p>
                    <p>Action</p>
                </div>
                <div class="table-product-body">
                    @if (count($blogs) > 0)
                        @foreach ($blogs as $blog)
                            <p>{{$blog->id}}</p>
                            <p>{{$blog->title}}</p>
                            <p>{{$blog->description}}</p>
                            <img src="{{ asset('images/' . $blog->image) }}" />
                            <p>{{$blog->category}}</p>
                            <div >
                                <a href="{{route('blogs.edit', $blog->id)}}" class="btn btn-success" >
                                    <i class="fas fa-pencil-alt" ></i>
                                </a>
                                <form method="post" action=" {{ route('blogs.destroy', $blog->id) }} ">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" onclick="deleteConfirm(event)">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    @else
                        <p>No blogs found</p>
                    @endif
                </div>
                <div class="table-paginate">
                    {{ $blogs->links('layouts.pagination')}}
                </div>
            </div>
        </section>
    </main>
    <script>
        window.deleteConfirm = function (event) {
            event.preventDefault();
            var form = event.target.form;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>
@endsection
