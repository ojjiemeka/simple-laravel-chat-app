@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">User Chat</div>
                <div class="card-body">
                    <div class="container mb-5 message-body">
                        @foreach ($messages as $item)
                            @if ($item->sender == Auth::user()->id)
                                <div class="self mb-3">
                                    <strong class="user">{{Auth::user()->name}}</strong>
                                    <p class="body">{{$item->message}}</p>
                                </div>
                            @endif

                            @if ($item->sender === 'admin')
                            <div class="message mb-3">
                                <strong class="user">Admin</strong>
                                <p class="body">{{$item->message}}</p>
                            </div>
                            @endif
                        @endforeach
                    </div>
                   <div>
                    <form class="form" action="{{ route('send-message') }}" method="POST">
                        @csrf
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                            <span class="notice">
                                Hit Return to send a message
                            </span>
                          </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary text-light">SEND</button>
                          </div>
                    </form>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card">
                <div class="card-header text-center">Info</div>
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <p>Status: {{$user->status}} </p>
                    </div>

                    @if ($user->status === 'pending')
                    <div>
                        <i class='bx bxs-user bx-sm text-warning' ></i>
                    </div>
                    @elseif ($user->status === 'active')
                    <div>
                        <i class='bx bxs-user bx-sm text-success' ></i>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

