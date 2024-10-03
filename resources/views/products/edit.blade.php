@extends('adminlte::page')

@section('title', 'Cadastro de produtos')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Editando produto</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Produto') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.update', $product->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <select id="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Nome do Produto</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $product->name) }}" required autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Preço</label>
                            <input id="price" type="number" step="0.01"
                                class="form-control @error('price') is-invalid @enderror" name="price"
                                value="{{ old('price', $product->price) }}" required>

                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Atualizar Produto') }}
                            </button>
                            <a class="btn btn-primary" href="/products" role="button">Voltar</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
