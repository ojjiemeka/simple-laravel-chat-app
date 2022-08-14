@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">Chats</div>
                <div class="card-body">
                    <div class="container mb-5 mt-2 message-body">
                        @foreach ($messages as $item)
                        <div class="message  mb-3">
                            <strong class="user">{{$item->name}}</strong>
                            <p class="body">{{$item->message}}</p>
                        </div>
                        @endforeach

                        @foreach ($admins as $item)
                        <div class="self mb-2">
                            <strong class="user">{{Auth::user()->name}}</strong>
                            <p class="body">{{$item->message}}</p>
                        </div>
                        @endforeach

                        {{-- <div class="self">
                            <strong class="user">{{Auth::user()->name}}</strong>
                            <p class="body">{{$admins->message}}</p>
                        </div> --}}
                    </div>
                   <div>
                    <form class="form" action="{{ route('chats.store') }}" method="POST">
                        @csrf
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                            <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <span class="notice">
                                {{$user->id}}
                            </span>
                            <input type="hidden" name="user_id" value="{{$user->id}}">
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
                <div class="card-header text-center">User</div>
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <p >{{ $user->name }}</p>
                    </div>

                    @if ($user->status === 'pending')
                    <div>
                        <i class='bx bxs-user bx-md text-warning' ></i>
                    </div>
                    @elseif ($user->status === 'active')
                    <div>
                        <i class='bx bxs-user bx-md text-success' ></i>
                    </div>
                     @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
