@extends('layouts.app')

@section('title', __('student_class.create'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="class_id" class="form-label">{{ __('student_class.class') }} <span class="form-required">*</span></label>
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
                <div class="form-group">
                    <label for="student_id" class="form-label">{{ __('student_class.student_class') }} <span class="form-required">*</span></label>
                    <select name="student_id" id="student_id" class="form-control">
                        <option value="">-- {{ __('student_class.select_student') }} --</option>
                        {{-- @foreach ($classTypes as $classType)
                            <option value="{{ $classType->id }}">
                                {{ $classType->name }}
                            </option>
                        @endforeach --}}
                    </select>
                    {!! $errors->first('student_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
