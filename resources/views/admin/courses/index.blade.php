@extends('formbuilder::layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Courses') }}
                            @if (Auth::user()->isAdmin())
                                <div class="btn-toolbar float-md-right" role="toolbar">
                                    <div class="btn-group" role="group" aria-label="Third group">
                                        <a href="{{ route('courses.form') }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-plus-circle"></i> Create a New Course
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($courses->count())
                            <div class="table-responsive">
                                <table class="table table-bordered d-table table-striped pb-0 mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $course->title }}</td>
                                                <td>{{ $course->description }}</td>
                                                <td>{{ $course->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                        <h4 class="text-danger text-center">
                            No courses to display
                        </h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
