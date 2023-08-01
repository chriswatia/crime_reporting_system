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
.contact_us {
    background: linear-gradient(to bottom,#000000, rgb(55, 55, 247),#47b2ff);
    margin-bottom: -20%;
}
.contact_us h1{
    font-size: 40px;
    font-weight: bolder;
}
.contactus {
    position: relative;
    display: inline-block;
    margin-top: 35px;
    margin-left: 10%;
    margin-bottom: 40px;
    width: 80%;
    height: 700px;
    background-size: cover;
    background-position: center center;
    transition: transform 0.5s ease;
  }
  
  .contactus:hover {
    transform: scale(1.1);
  }

  .contactus .description {
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
  .contactus:hover .description {
    opacity: 2;
  }
  .contactus .description h2 {
    text-transform: uppercase;
    font-weight: bold;
    color: rgb(130, 177, 247);
    font-size: 50px;
    font-family: 'Alkatra', cursive;
    font-family: 'Rubik', sans-serif;  
}
  .contactus .description h2:hover{
    color: white;
  }
  .contactus .description p {
    /* text-transform: uppercase; */
    font-size: 20px;
    font-family: 'Alkatra', cursive;
    font-family: 'Rubik', sans-serif;  
}

.contactus .description h3 {
    font-size: 20px;
    font-family: 'Alkatra', cursive;
    font-family: 'Rubik', sans-serif;

}
</style>
        <!-- SUB BANNER -->
        <section class="section-sub-banner">
            <div class="sub-banner">
                <div class="container">
                    <div class="text text-center">
                        <h2>CONTACT US</h2>
                    </div>
                </div>
            </div>
        </section>


        <!-- contactus -->
    <section class="contact_us">
        <div class="contactus" style="background-image: url('images/contact.jpg')">
            <div class="description">
                
                    {{-- <p>Thank you for your interest in Scorpion Crime Tracker. We value your feedback, inquiries, and suggestions. Please feel free to reach out to us using the contact details provided below:</p> --}}

                    <h3>General Inquiries</h3>
                    <p>Email: info@scorpiontracker.com</p>
                    <p>Phone: +254 712 345 678</p>

                    <h3>Technical Support</h3>
                    <p>Email: support@scorpiontracker.com</p>
                    <p>Phone: +254 722 987 654</p>

                    <h3>Partnerships</h3>
                    <p>Email: partnerships@scorpiontracker.com</p>
                    <p>Phone: +254 733 456 789</p>

                    <h3>Address</h3>
                    <p>Scorpion Crime Tracker Headquarters</p>
                    <p>123 Main Street</p>
                    <p>Eldoret, Kenya</p>

                    <p>We strive to respond to all inquiries promptly. Please allow up to 24 hours for a response. Thank you for your patience.</p>
            </div>
        </div>       
    </section>
{{-- <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contact Us') }}</div>

                <div class="card-body">
                    <h2>Contact Scorpion Crime Tracker</h2>
                    <p>Thank you for your interest in Scorpion Crime Tracker. We value your feedback, inquiries, and suggestions. Please feel free to reach out to us using the contact details provided below:</p>

                    <h3>General Inquiries</h3>
                    <p>Email: info@scorpiontracker.com</p>
                    <p>Phone: +254 712 345 678</p>

                    <h3>Technical Support</h3>
                    <p>Email: support@scorpiontracker.com</p>
                    <p>Phone: +254 722 987 654</p>

                    <h3>Partnerships</h3>
                    <p>Email: partnerships@scorpiontracker.com</p>
                    <p>Phone: +254 733 456 789</p>

                    <h3>Address</h3>
                    <p>Scorpion Crime Tracker Headquarters</p>
                    <p>123 Main Street</p>
                    <p>Eldoret, Kenya</p>

                    <p>We strive to respond to all inquiries promptly. Please allow up to 24 hours for a response. Thank you for your patience.</p>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
