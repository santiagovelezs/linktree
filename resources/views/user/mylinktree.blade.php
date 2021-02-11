@extends('layouts.app')

@section('body')

<body style='background-image:url({{ asset('storage/images/temas/'.$myLinktree->imagesTema->url_image) }})' >

    <div class="container">
        <div class="row justify-content-center">
          <div class="col-2 mt-3">
            
                <p class="text-muted text-center">
                    @<?php echo $user->username ?>                                       
                </p>                         
    
            </div>            
        </div>
        <div class="row justify-content-center">
            <div class="col-2 mt-3">            
                
                @if ($user->url_image)
                    <img  id="profile_img" class="img-fluid rounded-circle" src="{{ asset('storage/'.$user->url_image) }}" onclick="file.click()" /> 
                @else
                    <img height="250" id="profile_img" class="img-fluid rounded-circle" src="{{ asset('storage/images/select-image.png') }}" onclick="file.click()" />
                @endif              
    
            </div>
        </div> 
        <div class="row justify-content-center">
            <div class="col-6 mt-3">            
                <div class="d-grid gap-5 col-8 mx-auto">
                @foreach ($links as $link)  
                    <div class="text-center mb-3">                   
                        <button type="button" class="btn btn-outline-primary btn-lg btn-block">{{$link->label}}</button>
                    </div>
                @endforeach            
                </div>
            </div>                
        </div> 
        <div class="row justify-content-center">
                       
                
                @foreach ($socialNetworks as $socialNetwork)  
                <div class="col-1 mt-3"> 
                    <div class="text-center mb-3">                   
                        <a href="{{ $socialNetwork->url }}"><i class="{{ $socialNetwork->getIcon() }}"></i></a>
                    </div>
                </div> 
                @endforeach            
                
                           
        </div> 
    </div>    
    
</body>   

@endsection
