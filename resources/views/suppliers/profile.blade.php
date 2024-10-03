@extends('adminlte::page')

@section('title', 'Perfil')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
      <div class="col-md-3">
         <!-- Profile Image -->
         <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="./vendor/adminlte/dist/img/user-profile.jpg"
                     alt="User profile picture">
              </div>
              <h3 class="profile-username text-center">{{ $user->name }}</h3>
              <p class="text-muted text-center">Fornecedor</p>
              <a href="/suppliers" class="btn btn-primary btn-block"><b>Dashboard Fornecedor</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </div>
    </div>
</div>
@stop

