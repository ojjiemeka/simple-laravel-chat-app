@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">Chats</div>
                <div class="card-body">
                    <div class="container mb-5">
                        <div class="message self">
                            <strong class="user">Krunal</strong>
                            <p class="body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam cumque quaerat rem quia veniam exercitationem, commodi numquam omnis! Non placeat perspiciatis nulla illum cumque ad natus asperiores fuga. Facere, dignissimos.</p>
                        </div>
                    </div>
                   <div>
                    <form class="form">
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                <div class="card-header text-center">Users</div>
                <div class="card-body d-flex justify-content-between">
                    @foreach ($users as $user)
                    <div>
                        <a href="{{ route('chats.show', $user->id) }}">{{ $user->name }}</a>
                    </div>

                    @if ($user->status == 'pending')
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-warning" width="24" height="24" style="fill: rgba(255, 193, 7, 1);transform: ;msFilter:;"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg>
                        <i class='bx bx-user bx-md' ></i>
                    </div>
                    @elseif ($user->status == 'active')
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-warning" width="24" height="24" style="fill: rgba(40, 167, 69, 1);transform: ;msFilter:;"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg>
                        <i class='bx bx-user bx-md' ></i>
                    </div>

                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
