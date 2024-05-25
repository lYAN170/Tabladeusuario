@extends('layouts.admin')
 
@section('main-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ __('Editar Departamento') }}</h1>
 
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="direccion">{{ __('Direccion') }}</label>
            <input type="text" name="direccion" class="form-control" id="direccion" value="{{ old('direccion', $departamento->direccion) }}" required>
        </div>
        <div class="form-group">
            <label for="renta">{{ __('Renta') }}</label>
            <input type="number" name="renta" class="form-control" id="renta" value="{{ old('renta', $departamento->renta) }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
    </div>

@endsection
 