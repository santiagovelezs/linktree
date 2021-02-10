@extends('layouts.nav')

@section('content')
<div class="container">
    <h1>Editar un enlace</h1>
    @include('layouts.sub_form-errors')
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    <form action="{{ route('links.update', $link->id) }}" method="post">
        @csrf
        @method('put')
        @include('links.sub_form')
        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
</div>
@endsection
