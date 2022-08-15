@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="align-items-center card-header d-flex justify-content-between">
                    <p>Users</p>
                    <a href="/history">
                        <i class='bx bx-history bx-sm' ></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="container mb-5 text-center">
                        <div class="mb-3">
                            <input class="form-control" id="myInput" type="text" placeholder="Search..">
                        </div>
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                <thead class="table-light">
                                    <tr class="text-muted">
                                        <th>ID</th>
                                        <th class="text-uppercase text-center">Action</th>
                                        <th class="text-uppercase text-center">Name</th>
                                        <th class="text-uppercase text-center">Email</th>
                                        <th class="text-uppercase text-center">Phone</th>
                                        <th class="text-uppercase text-center">Status</th>
                                    </tr>
                                </thead>

                                <tbody id="myTable">
                                    @if ($users->count())
                                    @foreach ($users as $user)
                                        <tr data-id="1">
                                            <td data-field="id">{{ $number++ }}</td>
                                            <td >
                                                <div class="d-flex justify-content-evenly">
                                                    <div class="">
                                                        <a class="btn text-muted btn-sm edit waves-effect"
                                                            href="{{ route('chats.show', $user->id) }}">
                                                            <i class='bx bxs-conversation bx-sm'></i>
                                                        </a>
                                                    </div>
                                                    <div class="">
                                                        <a class="btn text-primary btn-sm edit waves-effect"
                                                            href="{{ route('users.show', $user->id) }}">
                                                            <i class="bx bx-pencil bx-sm "></i>
                                                        </a>
                                                    </div>
                                                    <div class="">
                                                        <form method="POST" action="{{ route('users.destroy', $user->id ) }}">
                                                          @csrf
                                                          <input type="hidden" name="_method" value="DELETE">
                                                          <button type="submit" class="btn text-danger btn-sm edit waves-effect" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
                                                            <i class=" bx bx-sm bx-trash"></i>
                                                          </button>
                                                        </form>
                                                  </div>
                                                </div>
                                            </td>
                                            <td data-field="name"> {{ $user->name }}</td>
                                            <td data-field="email">{{ $user->email }}</td>
                                            <td data-field="phome">{{ $user->phone}}</td>
                                            <td data-field="status">
                                                @if ($user->status == 'pending')
                                                    <span
                                                        class="badge text-bg-warning text-uppercase">{{ $user->status }}</span>
                                                @elseif ($user->status == 'inactive')
                                                    <span
                                                        class="badge text-bg-danger text-uppercase">{{ $user->status }}</span>
                                                @elseif ($user->status == 'active')
                                                    <span
                                                        class="badge text-bg-success">{{ $user->status }}</span>
                                                @endif
                                            </td>
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
                    <script>
                        $(document).ready(function(){
                          $("#myInput").on("keyup", function() {
                            var value = $(this).val().toLowerCase();
                            $("#myTable tr").filter(function() {
                              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                            });
                          });
                        });
                        </script>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
