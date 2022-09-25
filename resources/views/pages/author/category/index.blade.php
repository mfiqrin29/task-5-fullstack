@extends('layouts.base')

@section('title', 'Blog | Category')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Category</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('author.category.create') }}">
                <button class="btn btn-sm btn-primary">Create Category</button>
            </a>            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td class="d-flex">
                                <a href="{{ route('author.category.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('author.category.destroy', $category->id) }}" method="POST">
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