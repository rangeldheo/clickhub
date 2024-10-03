@extends('adminlte::page')

@section('title', 'Central Container')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Escolha seu perfil:</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<section class="content">
    <div class="container-fluid">
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
              <h3 class="profile-username text-center">Quero ser um fornecedor</h3>
              <p class="text-muted text-center">Venda através do nosso programa de fornecedores da ClickHub</p>
              <a href="/suppliers/create" class="btn btn-primary btn-block"><b>Ativar perfil de fornecedor</b></a>
            </div>
            <!-- /.card-body -->
          </div>
        </div>

        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="./vendor/adminlte/dist/img/user-profile.jpg"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">Quero ser um afiliado</h3>
                <p class="text-muted text-center">Quero vender os produtos dos fornecedores exclusivos da ClickHub</p>
                <a href="/clients/create" class="btn btn-success btn-block"><b>Ativar perfil de afiliado</b></a>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
      </div>
    </div>
</section>
@stop

@section('css')
    <style>
        body {
            margin: 0;
        }
    </style>
@stop

