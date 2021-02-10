@extends('layouts.nav')

@section('content')

    <div class="container">
        <h1>Mis redes sociales</h1>
        <a type="button" class="btn btn-primary mb-4 mt-2" href="{{ route('social-networks.create') }}"><i class="far fa-plus-square"></i> Crear red social</a>
        <table class="table table-striped table-hover">
            <tr>
                <th scope="col">Código</td>
                <th scope="col">Tipo</td>
                <th scope="col">URL</td>
                <th scope="col">Opciones</td>
            </tr>

            @foreach ($socialNetworks as $socialNetwork)
                <tr>
                    <td>{{ $socialNetwork->id }}</td>
                    <td><i class="{{ $socialNetwork->getIcon() }}"></i></td>
                    <td><a href="{{ $socialNetwork->url }}">{{ $socialNetwork->url }}</a></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Link options">
                            <a href="{{ route('social-networks.show', $socialNetwork->id) }}" class="btn btn-info" title="Ver"><i class="far fa-eye"></i></a>
                            <a href="{{ route('social-networks.edit', $socialNetwork->id) }}" class="btn btn-warning" title="Editar"><i class="far fa-edit"></i></a>
                            <form action="{{ route('social-networks.destroy', $socialNetwork->id) }}" method="post"
                                onsubmit="return confirm('¿Esta seguro que desea remover esta red social?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" title="Remover"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $socialNetworks->links() }}
    </div>

@endsection
