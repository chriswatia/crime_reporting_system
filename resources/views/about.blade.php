@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('About Us') }}</div>

                <div class="card-body">
                    <h2>Welcome to Scorpion Crime Tracker</h2>
                    <p>Scorpion Crime Tracker is a revolutionary web application that aims to empower communities in the fight against crime. Our mission is to create a safer environment by providing a comprehensive platform for reporting and tracking criminal activities.</p>

                    <h3>How Scorpion Crime Tracker Works</h3>
                    <p>Scorpion Crime Tracker allows users to report crimes they have witnessed or experienced directly through our user-friendly interface. The reports can include details such as the type of crime, location, date, and any relevant information that can assist law enforcement agencies in their investigations.</p>

                    <p>Once a report is submitted, it becomes part of our centralized database, which helps us analyze crime patterns, identify hotspots, and generate valuable insights. This information is made available to law enforcement agencies and community members, enabling them to take proactive measures to prevent and combat crime.</p>

                    <h3>Our Commitment</h3>
                    <p>At Scorpion Crime Tracker, we are committed to maintaining the privacy and security of our users' information. We adhere to strict data protection protocols and ensure that all personal information is handled with utmost care. We believe in the power of community collaboration and the positive impact it can have on crime prevention.</p>

                    <p>Join us in the fight against crime and help create safer neighborhoods for everyone. Together, we can make a difference!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
