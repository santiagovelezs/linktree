@extends('layouts.nav')

@section('content')
<div class="container">
    <h1>Mi Cuenta</h1>
    <p class="text-muted">@<?php echo $user->username ?></p>
    @include('layouts.sub_form-errors')   
    <div class="card mt-4"> 
        <div class="card-body"> 
            <form action="{{ route('user.update', $user) }}" method="post">
                @csrf
                @method('put')
                @include('user.sub_form')
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            Perfil
        </div>
        <div class="card-body">  
            @if ($user->url_image)
                <img width="125" id="profile_img" class="img-fluid rounded-circle" src="{{ asset('storage/'.$user->url_image) }}" onclick="file.click()" /> 
            @else
                <img width="125" id="profile_img" class="img-fluid rounded-circle" src="{{ asset('storage/images/select-image.png') }}" onclick="file.click()" />
            @endif   
            
                
                   
            
        </div>
        <div class="card-footer">
            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" accept="image/*" name="file" class="d-none" id="file">
                <button type="submit" class="btn btn-success">Cambiar imagen</button>
            </form>
            
        </div>
    </div>
</div>

@endsection

@section('js')

<script type="text/javascript" defer>
     
$(document).ready(function (e) 
{   
   $('#file').change(function()
   {
       let reader = new FileReader(); 
        reader.onload = (e) => {
            $('#profile_img').attr('src', e.target.result); 
        } 
        reader.readAsDataURL(this.files[0]);    
   });   
});
 
</script>

@endsection