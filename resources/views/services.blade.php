@extends('layouts.app')

@section('content')
<style>
    .section-sub-banner{
    padding-top:80px;
    background: linear-gradient(to bottom,#363bc8,rgb(95, 84, 255),#000000);
      
}
.sub-banner{
    position:relative;
}
.sub-banner .text{
    padding-bottom:50px;
}
.sub-banner .text h2{
    margin-top:70px;
    margin-bottom:0;
    color:#ffffff;
    font-size:68px;
    font-family: 'Alkatra', cursive;
    font-family: 'Rubik', sans-serif; 
    font-weight: bolder;
    text-transform:uppercase;
    animation: move-color 10s ease-in-out infinite;
    text-shadow: #000000;
}

.sub-banner .text p{
    margin-bottom:0;
    color:#ffffff;
    font-size:30px;
    font-weight: bold;
}
.services {
    background: linear-gradient(to bottom,#000000, rgb(55, 55, 247),#47b2ff);
    margin-bottom: -20%;
}
.services h1{
    font-size: 40px;
    font-weight: bolder;
}
.service {
    position: relative;
    display: inline-block;
    margin-top: 35px;
    margin-left: 10%;
    margin-bottom: 30px;
    width: 80%;
    height: 700px;
    background-size: cover;
    background-position: center center;
    transition: transform 0.5s ease;
  }
  
  .service:hover {
    transform: scale(1.1);
  }

  .service .description {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.5s ease;
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff;
    text-align: center;
    padding-top: 80px;
  }
  .service:hover .description {
    opacity: 2;
  }
  .service .description h2 {
    text-transform: uppercase;
    font-weight: bold;
    color: rgb(130, 177, 247);
    font-size: 50px;
    font-family: 'Alkatra', cursive;
    font-family: 'Rubik', sans-serif;  
}
  .service .description h2:hover{
    color: white;
  }
  .service .description p {
    font-size: 20px;
    margin-top: 10%;
    font-family: 'Alkatra', cursive;
    font-family: 'Rubik', sans-serif;  
}
</style>
        <!-- SUB BANNER -->
        <section class="section-sub-banner">
            <div class="sub-banner">
                <div class="container">
                    <div class="text text-center">
                        <h2>Scorpion Crime Tracker Services</h2>
                    </div>
                </div>
            </div>
        </section>


        <!-- service -->
    <section class="services">
        <div class="service" style="background-image: url('images/services.jpg')">
            <div class="description">
                <h2>Crime Reporting</h2>
                <p>Our platform allows users to report crimes they have witnessed or experienced. By providing a user-friendly interface, we make it easy for individuals to submit detailed reports, including crime type, location, date, and any relevant information. These reports contribute to our centralized database and help generate valuable insights for law enforcement agencies.</p>
            </div>
        </div>       
    </section>
{{-- <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Our Services') }}</div>

                <div class="card-body">
                    <h2>Scorpion Crime Tracker Services</h2>
                    <p>Scorpion Crime Tracker offers a range of services aimed at empowering communities, enhancing crime prevention efforts, and promoting a safer environment. Our services include:</p>

                    <h3></h3>
                    <p></p>

                    <p>At Scorpion Crime Tracker, we are committed to making a difference. Through our comprehensive services, we strive to foster a collaborative approach to crime prevention and create safer communities for everyone.</p>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
