@extends('layouts.master')

@section('title', 'Edit User')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit User
                <a href="{{ url('admin/users') }}" class="btn btn-primary btn-sm float-end">Back
                </a>
            </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/edit-user/'.$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="firstname" value="{{ $user->firstname }}" id="" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="lastname" value="{{ $user->lastname }}" id="" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" id="" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Phone</label>
                        <div class="form-inline">
                            <select name="country_code" class="form-control selectpicker col-3" data-live-search="true" required="required">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->country_code }}">{{ '('.$country->country_code.')'.' '. $country->country_name .' - '.$country->iso_code }}</option>
                                @endforeach
                            </select>

                            <input type="tel" name="phone" value="{{ $user->phone }}" id="" class="form-control col-9" required placeholder="700112233">
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="">Gender</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="gender">                                    
                        {{-- <option>Choose Gender</option> --}}
                        <option value="Male" @if (old($user->gender) == "Male") {{ "selected" }} @endif>Male</option>
                        <option value="Female" @if (old($user->gender) == "Female") {{ "selected" }} @endif>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Address</label>
                        <textarea name="address" class="form-control">{{ $user->address }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Role</label>
                        @if (Auth::user()->role_id == 1)
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="role_id">
                            <option selected></option>
                            @foreach ($roles as $role)
                            
                            <option {{ old('role_id', $user->role_id) ==  $role->id ? 'selected' : ''}} value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach                            
                        </select>
                        @else
                        <input type="text" name="" value="{{ App\Models\Role::where('id',$user->role_id)->first()->name  }}" id="" class="form-control" readonly>
                        @endif
                        
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
$(document).ready(function() {
    $('#country').on('keyup', function() {
    var value = $(this).val().toLowerCase();
    $('option').hide();
    $('option').filter(function() {
        return $(this).text().toLowerCase().indexOf(value) > -1;
    }).show();
    });
});
</script>
