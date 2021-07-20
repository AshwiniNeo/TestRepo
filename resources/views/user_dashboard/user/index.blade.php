@extends('layouts.header')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-6">
                <a class="btn btn-primary float-right" id="btn_add_new" >Add New</a>
            </div>
        </div>
    </div>
</section>
<br>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Email verified on</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($users as $user)
    <tr>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->email_verified_at }}</td>
      <td>
        <a href="{{ route('edit-user', base64_encode($user->id) ) }}"><i class="fas fa-edit" aria-hidden="true"></i></a> 
        <a href="{{ route('delete-user', base64_encode($user->id) ) }}" onclick="return confirm('Are you sure?')" ><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection