@extends('layouts.app')

@section('title', __('student_class.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('student_class.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('student_class.name') }}</td><td>{{ $studentClass->name }}</td></tr>
                        <tr><td>{{ __('student_class.class') }}</td><td>{{ $studentClass->classType->name }}</td></tr>
                        <tr><td>{{ __('student_class.description') }}</td><td>{{ $studentClass->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $studentClass)
                    <a href="{{ route('student_classes.edit', $studentClass) }}" id="edit-student_class-{{ $studentClass->id }}" class="btn btn-warning">{{ __('student_class.edit') }}</a>
                @endcan
                <a href="{{ route('student_classes.index') }}" class="btn btn-link">{{ __('student_class.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
