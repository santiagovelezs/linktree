@extends('layouts.nav')

@section('content')
<div class="container">
    <h1>Ver red social</h1>
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col" style="width: 200px">Id</th>
            <td>{{ $socialNetwork->id }}</td>
        </tr>
        <tr>
            <th scope="col">Tipo</th>
            <td>{{ $socialNetwork->type }}</td>
        </tr>
        <tr>
            <th scope="col">Enlace</th>
            <td>{{ $socialNetwork->url }}</td>
        </tr>
        <tr>
            <th scope="col">Propietario</th>
            <td>{{ $socialNetwork->owner->name }}</td>
        </tr>
        <tr>
            <th scope="col">Creado en</th>
            <td>{{ $socialNetwork->created_at ?? "Desconocida" }}</td>
        </tr>
        <tr>
            <th scope="col">Actualizado en</th>
            <td>{{ $socialNetwork->updated_at ?? "Desconocida"  }}</td>
        </tr>
    </table>

    <div class="btn-group" role="group" aria-label="Link options">
        <a href="{{ route('social-networks.edit', $socialNetwork->id) }}" class="btn btn-warning" title="Editar"><i class="far fa-edit"></i></a>
        <form action="{{ route('social-networks.destroy', $socialNetwork->id) }}" method="post"
            onsubmit="return confirm('¿Esta seguro que desea remover la red social?')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" title="Remover"><i class="fas fa-trash"></i></button>
        </form>
    </div>
</div>
@endsection