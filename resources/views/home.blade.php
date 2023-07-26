@extends('layouts.app')

@section('content')
<style>
    /* CSS for the image */
    .homepage-image {
        width: 100%; /* Adjust the width of the image as needed */
        height: 755px; /* Automatically adjust the height while maintaining the aspect ratio */
        display: block; /* Ensures the image is displayed as a block element */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow effect (optional) */
        margin-top: -85px;
        margin-bottom: -25px;
    }
    .image-caption {
        position: absolute;
        top: 60%; /* Adjust the vertical position of the caption */
        left: 30%; /* Adjust the horizontal position of the caption */
        color: white; /* Adjust the text color of the caption */
        text-align: center;
        font-size: 50px;
        font-weight: bolder;
        font-style: oblique;
        text-transform: uppercase;
        text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.8);

    }
</style>

<div class="image-container">
    <img class="homepage-image" src="{{ asset('Images/homepage.jpg') }}" alt="Your Image Alt Text">
    <div class="image-caption">Report. Resolve. Reclaim. <br><br> Your Voice Against Crime.</div>
</div>

{{-- <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    
                    <!-- {{ __('You are logged in!') }} -->
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
