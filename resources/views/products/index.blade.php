@extends('adminlte::page')

@section('title', 'Cadastro de produtos')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Meus Produtos</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Produtos do Fornecedor</h3>
            <div class="card-tools">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Adicionar Produto</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
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
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Tem certeza que deseja deletar este produto?');">Deletar</button>
                                </form>
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
                    <a class="btn btn-primary btn-block" href="/suppliers" role="button">Dashboard</a>
                </div>
                <div class="col-md-9">
                    <!-- Links de paginação -->
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
