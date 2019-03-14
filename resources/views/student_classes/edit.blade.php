@extends('layouts.app')

@section('title', __('student_class.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $studentClass)
        @can('delete', $studentClass)
            <div class="card">
                <div class="card-header">{{ __('student_class.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('student_class.name') }}</label>
                    <p>{{ $studentClass->name }}</p>
                    <label class="form-label text-primary">{{ __('student_class.class') }}</label>
                    <p>{{ $studentClass->classType->name }}</p>
                    <label class="form-label text-primary">{{ __('student_class.description') }}</label>
                    <p>{{ $studentClass->description }}</p>
                    {!! $errors->first('student_class_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('student_class.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('student_classes.destroy', $studentClass) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="student_class_id" type="hidden" value="{{ $studentClass->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('student_classes.edit', $studentClass) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('student_class.edit') }}</div>
            <form method="POST" action="{{ route('student_classes.update', $studentClass) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('student_class.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $studentClass->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="class_id" class="form-label">{{ __('student_class.class') }} <span class="form-required">*</span></label>
                        <select name="class_id" id="class_id" class="form-control" required>
                            <option value="">{{ __('student_class.select_class') }}</option>
                            @foreach ($classTypes as $classType)
                                <option value="{{ $classType->id }}"
                                    {{ $studentClass->class_id === $classType->id ? 'selected' : '' }}>
                                    {{ $classType->name }}
                                </option>
                            @endforeach
                        </select>
                        {!! $errors->first('class_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('student_class.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $studentClass->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('student_class.update') }}" class="btn btn-success">
                    <a href="{{ route('student_classes.show', $studentClass) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $studentClass)
                        <a href="{{ route('student_classes.edit', [$studentClass, 'action' => 'delete']) }}" id="del-student_class-{{ $studentClass->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
