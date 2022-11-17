@extends('user.user')

@section('title', 'Reported Crimes')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Reported Crime
                    <a href="{{ url('/add-crime') }}" class="btn btn-primary btn-sm float-end">Report Crime
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
                            <th>Status</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($crimes as $crime)
                            <tr>
                                <td>{{ $crime->id }}</td>
                                <td>{{ App\Models\CrimeCategory::where('id', $crime->category_id)->first()->category_name }}</td>
                                <td>{{ $crime->description }}</td>         
                                <td>{{ $crime->status }}</td>                          
                                <td>{{ $crime->created_at->toDateString() }}</td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ url('crime_status/' . $crime->id) }}">View Progress</a>
                                    {{-- <a class="btn btn-danger btn-sm" href="{{ url('admin/delete-crime_category/' . $crime->id) }}">Delete</a> --}}

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
