@extends('layouts.base')

@section('title', 'Blog | Create User')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create User</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class="form-group">
                    <label for="roles">roles</label>
                    <select name="roles" class="form-control" required>
                        <option value="ADMIN">Admin</option>
                        <option value="AUTHOR">Author</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
    </div>

</div>
@endsection