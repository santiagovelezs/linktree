@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Mis enlaces</h1>
        <a type="button" class="btn btn-primary mb-4 mt-2" href="{{ route('links.create') }}"><i class="far fa-plus-square"></i> Crear enlace</a>
        <table class="table table-striped table-hover">
            <tr>
                <th scope="col">Código</td>
                <th scope="col">Etiqueta</td>
                <th scope="col">URL</td>
                <th scope="col">Opciones</td>
            </tr>

            @foreach ($links as $link)
                <tr>
                    <td>{{ $link->id }}</td>
                    <td>{{ $link->label }}</td>
                    <td><a href="{{ $link->url }}">{{ $link->url }}</a></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Link options">
                            <a href="{{ route('links.show', $link->id) }}" class="btn btn-info"><i class="far fa-eye"></i></a>
                            <form action="{{ route('links.destroy', $link->id) }}" method="post"
                                onsubmit="return confirm('¿Esta seguro que desea remover el enlace?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
