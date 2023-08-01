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
.about_us {
    background: linear-gradient(to bottom,#000000, rgb(55, 55, 247),#47b2ff);
    margin-bottom: -20%;
}
.about_us h1{
    font-size: 40px;
    font-weight: bolder;
}
.aboutus {
    position: relative;
    display: inline-block;
    margin-top: 35px;
    margin-left: 20%;
    margin-bottom: 30px;
    width: 50%;
    height: 500px;
    background-size: cover;
    background-position: center center;
    transition: transform 0.5s ease;
  }
  
  .aboutus:hover {
    transform: scale(1.1);
  }

  .aboutus .description {
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
  .aboutus:hover .description {
    opacity: 2;
  }
  .aboutus .description h2 {
    text-transform: uppercase;
    font-weight: bold;
    color: rgb(130, 177, 247);
    font-size: 50px;
    font-family: 'Alkatra', cursive;
    font-family: 'Rubik', sans-serif;  
}
  .aboutus .description h2:hover{
    color: white;
  }
  .aboutus .description p {
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
                        <h2>About Scorpion Crime Tracker</h2>
                    </div>
                </div>
            </div>
        </section>


        <!-- aboutus -->
    <section class="about_us">
        <div class="aboutus" style="background-image: url('images/about1.jpg')">
            <div class="description">
                <h2>Seamless Process</h2>
                <p>Report crimes directly through our user-friendly interface, providing essential details for effective law enforcement investigations. Your submissions become part of a centralized database, enabling crime pattern analysis and empowering communities and authorities with valuable insights for proactive crime prevention.</p>
            </div>
        </div>
        <div class="aboutus" style="background-image: url('images/about2.jpg')">
            <div class="description">
                <h2>Your Security, Our Priority</h2>
                <p>At Scorpion Crime Tracker, we prioritize your privacy and security with stringent data protection protocols. Join our community-driven approach to combat crime and build safer neighborhoods. Together, we can make a difference!</p>           
            </div>
        </div>        
    </section>
@endsection
