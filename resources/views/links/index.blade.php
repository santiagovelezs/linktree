@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Mis enlaces</h1>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col">Código</td>
            <th scope="col">Etiqueta</td>
            <th scope="col">URL</td>
        </tr>

        @foreach($links as $link)
        <tr>
            <td>{{ $link->id }}</td>
            <td>{{ $link->label }}</td>
            <td><a href="{{ $link->url }}">{{ $link->url }}</a></td>
            <td>
                <form action="{{ route('links.destroy', $link->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection