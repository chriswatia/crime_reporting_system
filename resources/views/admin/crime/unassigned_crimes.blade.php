@extends('layouts.master')

@section('title', 'Unassigned Crimes')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
            <h4 class="float-left">Unassigned Crimes</h4>
            <div class="d-flex float-right justify-content-end">
            <a href="{{ url('/admin/add-crime') }}" class="btn btn-primary btn-sm mr-2">Report Crime</a>
            <a href="{{ url('/admin/unassigned_crimes-export') }}" class="btn btn-warning btn-sm">Export</a>
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
                            <th>Ip Address</th>
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
                                    {{-- @if (!isset(App\Models\Crime::join('crime_assignment as ca', 'crimes.id', 'ca.crime_id')->where('crimes.id', $crime->id)->first()->id)) --}}
                                      <a class="btn btn-primary btn-sm" href="{{ url('admin/crime-assigment/' . $crime->id) }}">Assign</a>
                                    {{-- @else
                                        <a class="btn btn-success btn-sm" href="{{ url('admin/view-crime/' . $crime->id) }}">View Progress</a>
                                    @endif                           --}}

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
