@extends('formbuilder::layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h5 class="card-title">
                            Forms

                            <div class="btn-toolbar float-md-right" role="toolbar">
                                <div class="btn-group" role="group" aria-label="Third group">
                                    @if (Auth::user()->isAdmin())
                                        <a href="{{ route('formbuilder::forms.create') }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-plus-circle"></i> Create a New Form
                                        </a>
                                    @endif

                                    @if (Auth::user()->isStudent())
                                        <a href="{{ route('formbuilder::my-submissions.index') }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-th-list"></i> My Submissions
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </h5>
                    </div>

                    @if ($forms->count())
                        <div class="table-responsive">
                            <table class="table table-bordered d-table table-striped pb-0 mb-0 text-center">
                                <thead>
                                    <tr>
                                        @if (Auth::user()->isAdmin() or Auth::user()->isExamMaker() or Auth::user()->isStudent())
                                            <th class="five">#</th>
                                            <th>Name</th>
                                            <th>Course Name</th>
                                        @endif
                                        @if (Auth::user()->isAdmin())
                                            <th class="ten">Visibility</th>
                                            <th class="fifteen">Allows Edit?</th>
                                        @endif
                                        @if (Auth::user()->isAdmin() or Auth::user()->isExamMaker())
                                            <th class="ten">Submissions</th>
                                        @endif
                                        <th class="twenty-five">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($forms as $form)
                                        <tr>
                                            @if (Auth::user()->isAdmin() or Auth::user()->isExamMaker() or Auth::user()->isStudent())
                                                <td>{{ $loop->iteration }}</td>
                                            @endif
                                            @if (Auth::user()->isAdmin())
                                                <td><a
                                                        href="{{ route('formbuilder::forms.show', $form) }}">{{ $form->name }}</a>
                                                </td>
                                            @endif
                                            @if (Auth::user()->isExamMaker() or Auth::user()->isStudent())
                                                <td>{{ $form->name }}</td>
                                            @endif
                                            <td>
                                                @foreach ($courses as $course)
                                                    @if ($course->id == $form->course_id)
                                                        {{ $course->title }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            @if (Auth::user()->isAdmin())
                                                <td>{{ $form->visibility }}</td>
                                                <td>{{ $form->allowsEdit() ? 'YES' : 'NO' }}</td>
                                            @endif
                                            @if (Auth::user()->isAdmin() or Auth::user()->isExamMaker())
                                                <td>{{ $form->submissions_count }}</td>
                                            @endif
                                            <td>
                                                @if (Auth::user()->isAdmin() or Auth::user()->isExamMaker())
                                                    <a href="{{ route('formbuilder::forms.submissions.index', $form) }}"
                                                        class="btn btn-primary btn-sm"
                                                        title="View submissions for form '{{ $form->name }}'">
                                                        <i class="fa fa-th-list"></i> Data
                                                    </a>
                                                @endif
                                                @if (Auth::user()->isAdmin())
                                                    {{-- <a
                                                        href="{{ route('formbuilder::forms.show', $form) }}"
                                                        class="btn btn-primary btn-sm"
                                                        title="Preview form '{{ $form->name }}'">
                                                        <i class="fa fa-eye"></i>
                                                    </a> --}}
                                                    <a href="{{ route('formbuilder::forms.edit', $form) }}"
                                                        class="btn btn-primary btn-sm edit-icon" title="Edit form">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                @endif

                                                @if (Auth::user()->isAdmin() or Auth::user()->isStudent())
                                                    {{-- <button
                                                        class="btn btn-primary btn-sm clipboard link-icon"
                                                        data-clipboard-text="{{ route('formbuilder::form.render', $form->identifier) }}"
                                                        data-message="" data-original="" title="Copy form URL to clipboard">
                                                        <i class="fa fa-clipboard"></i>
                                                    </button> --}}
                                                    <a href="{{ route('formbuilder::form.render', $form->identifier) }}"
                                                        class="btn btn-primary btn-sm  link-icon">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                @endif
                                                @if (Auth::user()->isAdmin())
                                                    <form action="{{ route('formbuilder::forms.destroy', $form) }}"
                                                        method="POST" id="deleteFormForm_{{ $form->id }}"
                                                        class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger btn-sm confirm-form"
                                                            data-form="deleteFormForm_{{ $form->id }}"
                                                            data-message="Delete form '{{ $form->name }}'?"
                                                            title="Delete form '{{ $form->name }}'">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($forms->hasPages())
                            <div class="card-footer mb-0 pb-0">
                                <div>{{ $forms->links() }}</div>
                            </div>
                        @endif
                    @else
                        <div class="card-body">
                            <h4 class="text-danger text-center">
                                No form to display.
                            </h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
