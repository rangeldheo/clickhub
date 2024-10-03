@extends('adminlte::page')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Fornecedor</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-box"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Produtos cadastrados</span>
                            <span class="info-box-number">{{ $totalProducts }}</span>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Vendas</span>
                            <span class="info-box-number">0</span>
                        </div>

                    </div>

                </div>


                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Afiliados</span>
                            <span class="info-box-number">0</span>
                        </div>

                    </div>

                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Faturamento</span>
                            <span class="info-box-number">R$0,00</span>
                        </div>

                    </div>

                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box-content mb-2">
                        <a class="btn btn-primary btn-block" href="/products/create" role="button">Cadastrar
                            um produto</a>
                    </div>
                    <div class="info-box-content">
                        <a class="btn btn-primary btn-block" href="/products" role="button">Meus produtos</a>
                    </div>
                </div>

            </div>

        </div>
        </div>
    </section>
@endsection
