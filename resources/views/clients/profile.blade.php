@extends('adminlte::page')

@section('title', 'Perfil')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
      <div class="col-md-3">
         <!-- Profile Image -->
         <div class="card card-success card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="./vendor/adminlte/dist/img/user-profile.jpg"
                     alt="User profile picture">
              </div>
              <h3 class="profile-username text-center">{{ $user->name }}</h3>
              <p class="text-muted text-center">Afiliado</p>
              <a href="/clients" class="btn btn-success btn-block"><b>Dashboard Afiliado</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </div>
    </div>
</div>
@stop

