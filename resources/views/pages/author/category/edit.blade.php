@extends('layouts.base')

@section('title', 'Blog | Edit Category')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Category</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="{{ route('author.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan judul kategori" value="{{ $category->name }}">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
    </div>

</div>
@endsection