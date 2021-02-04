@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear un nuevo enlace</h1>
    <br>
    <form action="{{ route('links.store') }}" method="post">
        @csrf
        @include('links.sub_form')
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection