@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">Update User Status</div>
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @method('PUT')
                                    @csrf
                            <div class="row">
                                <div class="mb-5 col-md-6">
                                    <p class="fw-bold">Name: {{$user->name}}</p>
                                    <p class="fw-bold">Status:
                                        @if ($user->status == 'pending')
                                        <span class="text-warning text-uppercase">{{$user->status}}</span>
                                        @elseif ($user->status == 'active')
                                        <span class="text-success text-uppercase">{{$user->status}}</span>
                                        @elseif ($user->status == 'inactive')
                                        <span class="text-danger text-uppercase">{{$user->status}}</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="mb-3 col-md-6 text-center">
                                  <select class="form-select mb-3" name="status">
                                    <option selected>Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="inactive">Inactive</option>
                                  </select>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
