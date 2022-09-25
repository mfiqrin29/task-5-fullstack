@extends('layouts.base')

@section('title', 'Blog | Article')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Articles</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('author.article.create') }}">
                <button class="btn btn-sm btn-primary">Create Article</button>
            </a>            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Tanggal dibuat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->title }}</td>
                            <td><p>{!! $article->content !!}</p></td>
                            <td><img src="{{ asset('storage/article/'.$article->image) }}" width="30%" /></td>
                            <td>{{ $article->category->name }}</td>
                            <td>{{ $article->created_at }}</td>
                            <td class="d-flex">
                                <a href="{{ route('author.article.edit', $article->id) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('author.article.destroy', $article->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">
                                      <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>  
                        @endforeach                                                  
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection