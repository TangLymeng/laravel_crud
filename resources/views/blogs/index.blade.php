@extends('layouts.app')

@section('content')
    <main class="container">
        <section>
            <div class="titlebar">
                <h1>Blogs</h1>
                <a href="{{route('blogs.create')}}" class="btn-link"> Add Blog </a>
            </div>
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
                            <div>
                                <button class="btn btn-success" >
                                    <i class="fas fa-pencil-alt" ></i>
                                </button>
                                <button class="btn btn-danger" >
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        @endforeach

                    @else

                    @endif
                </div>
                <div class="table-paginate">
                    <div class="pagination">
                        <a href="#" disabled>&laquo;</a>
                        <a class="active-page">1</a>
                        <a>2</a>
                        <a>3</a>
                        <a href="#">&raquo;</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
