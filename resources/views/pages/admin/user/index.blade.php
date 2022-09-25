@extends('layouts.base')

@section('title', 'Blog | Manage Users')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Manage Users</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.user.create') }}">
                <button class="btn btn-sm btn-primary">Create User</button>
            </a>            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->roles }}</td>
                            <td class="d-flex">
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
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