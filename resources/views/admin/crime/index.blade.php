@extends('layouts.master')

@section('title', 'Reported Crimes')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Reported Crime
                    <a href="{{ url('/admin/add-crime') }}" class="btn btn-primary btn-sm float-end">Report Crime
                        </a>
                </h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Crime</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Device</th>
                            <th>Mac/Ip Address</th>
                            <th>Status</th>
                            <th>Date Reported</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($crimes as $crime)
                            <tr>
                                <td>{{ $crime->id }}</td>
                                <td>{{ App\Models\CrimeCategory::where('id', $crime->category_id)->first()->category_name }}</td>
                                <td>{{ $crime->description }}</td>  
                                <td>{{ $crime->crime_location }}</td>     
                                <td>{{ Str::limit($crime->device_type,31) }}</td>  
                                <td>{{ $crime->mac_address }}</td>         
                                <td>{{ $crime->status }}</td>                          
                                <td>{{ $crime->created_at->toDateString() }}</td>
                                <td>
                                    
                                    @if (!isset(App\Models\Crime::leftJoin('crime_assignment as ca', 'crimes.id', 'ca.crime_id')->where('crimes.id', $crime->id)->whereNull('crime_id')->first()->id))
                                      <a class="btn btn-primary btn-sm" href="{{ url('admin/assign' . $crime->id) }}">Assign</a>
                                        @else
                                        <a class="btn btn-success btn-sm" href="{{ url('admin/crime_status/' . $crime->id) }}">View Progress</a>
                                    @endif
                                    

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
