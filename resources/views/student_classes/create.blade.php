@extends('layouts.app')

@section('title', __('student_class.create'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('student_class.create') }}</div>
            <form method="POST" action="{{ route('student_classes.store') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('student_class.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="class_id" class="form-label">{{ __('student_class.class') }} <span class="form-required">*</span></label>
                        <select name="class_id" id="class_id" class="form-control">
                            <option value="">{{ __('student_class.select_class') }}</option>
                            @foreach ($classTypes as $classType)
                                <option value="{{ $classType->id }}">
                                    {{ $classType->name }}
                                </option>
                            @endforeach
                        </select>
                        {!! $errors->first('class_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('student_class.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('student_class.create') }}" class="btn btn-success">
                    <a href="{{ route('student_classes.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
