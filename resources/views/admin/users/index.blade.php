@extends('formbuilder::layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Users') }}
                            @if (Auth::user()->isAdmin())
                                <div class="btn-toolbar float-md-right" role="toolbar">
                                    <div class="btn-group" role="group" aria-label="Third group">
                                        <a href="{{ route('users.form') }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-plus-circle"></i> Create a New User
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($users->count())
                            <div class="table-responsive">
                                <table class="table table-bordered d-table table-striped pb-0 mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if($user->role_id == 1)
                                                        Admin
                                                    @endif
                                                    @if($user->role_id == 2)
                                                        Exam Maker
                                                    @endif
                                                    @if($user->role_id == 3)
                                                        Student
                                                    @endif
                                                </td>
                                                <td>{{ $user->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                        <h4 class="text-danger text-center">
                            No users to display
                        </h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
