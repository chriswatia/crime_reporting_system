@extends('user.user')

@section('title', 'Report Crime')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Report Crime</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('report-crime') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="">Crime</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required"
                            name="category_id">
                            <option selected>Select Crime Category</option>
                            @foreach (App\Models\CrimeCategory::all() as $crime_category)
                                <option value="{{ $crime_category->id }}">{{ $crime_category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="description" id="" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Location</label>
                        <input type="text" value="{{ $location }}" name="crime_location" id="" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">File</label>
                        <input type="file" name="file" id="" class="form-control">
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
