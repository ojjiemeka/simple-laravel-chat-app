@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">Message History</div>
                <div class="card-body">
                    <div class="container mb-5 text-center">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                <thead class="table-light">
                                    <tr class="text-muted">
                                        <th class="text-uppercase text-center">#</th>
                                        <th class="text-uppercase text-center">Name</th>
                                        <th class="text-uppercase text-center">Message</th>
                                        <th class="text-uppercase text-center">Time</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($items->count())
                                    @foreach ($items as $user)
                                        <tr data-id="1">
                                            <td data-field="id">{{ $number++ }}</td>

                                            <td data-field="name"> {{ $user->name }}</td>
                                            <td data-field="email">{{ $user->message }}</td>
                                            <td data-field="phome">{{ $user->created_at}}</td>
                                            <td data-field="status">
                                        </tr>
                                    @endforeach
                                    @else
                                            <th class="text-uppercase fs-5 text-center">no record found</th>
                                        @endif
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                            <div class="mt-3">
                                {{-- <h5>{{$clients->links()}}</h5> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
