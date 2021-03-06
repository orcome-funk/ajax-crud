@extends('layouts.app')

@section('title', __('student_class.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\StudentClass)
            <a href="{{ route('student_classes.create') }}" class="btn btn-success">{{ __('student_class.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('student_class.list') }} <small>{{ __('app.total') }} : {{ $studentClasses->total() }} {{ __('student_class.student_class') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    {{-- <div class="form-group">
                        <label for="q" class="form-label">{{ __('student_class.search') }}</label>
                        <input placeholder="{{ __('student_class.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div> --}}
                    <div class="form-group">
                        <label for="class_id" class="form-label">{{ __('student_class.select_class') }}</label>
                        <select name="class_id" id="class_id" class="form-control">
                            <option value="">-- {{ __('student_class.select_class') }} --</option>
                            @foreach ($classTypes as $classType)
                                <option value="{{ $classType->id }}">
                                    {{ $classType->name }}
                                </option>
                            @endforeach
                        </select>
                        {!! $errors->first('class_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <input type="submit" value="{{ __('student_class.search') }}" class="btn btn-secondary">
                    <a href="{{ route('student_classes.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('student_class.name') }}</th>
                        <th>{{ __('student_class.class') }}</th>
                        <th>{{ __('student_class.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studentClasses as $key => $studentClass)
                    <tr>
                        <td class="text-center">{{ $studentClasses->firstItem() + $key }}</td>
                        <td>{!! $studentClass->name_link !!}</td>
                        <td>{{ $studentClass->classType->name }}</td>
                        <td>{{ $studentClass->description }}</td>
                        <td class="text-center">
                            @can('view', $studentClass)
                                <a href="{{ route('student_classes.show', $studentClass) }}" id="show-student_class-{{ $studentClass->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $studentClasses->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
