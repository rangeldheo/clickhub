@extends('adminlte::page')

@section('title', 'Cadastro de produtos')
@section('content')

    <div class="row p-2">
        <div class="col-md-4 offset-8">
            <!-- Verifica se há uma mensagem de erro ou sucesso -->
            @if (session('error'))
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">oops!</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ session('error') }}
                    </div>
                </div>
            @elseif (session('success'))
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Tudo certo!</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Catálogo</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Nossos produtos</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th style="width: 400px;">Descrição</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>
                                @if ($product->clientProducts->isNotEmpty())
                                    <button class="btn btn-success btn-block">Você selecionou esse produto</button>
                                @else
                                    <form action="{{ route('product.chooseProduct', $product->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-primary btn-block">Vender esse
                                            produto</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Nenhum produto encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-3">
                    <a class="btn btn-primary btn-block" href="/client-catalog" role="button">Ver o meu catálogo de
                        produtos</a>
                </div>
                <div class="col-md-9">
                    <!-- Links de paginação -->
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
