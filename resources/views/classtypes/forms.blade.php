@if (Request::get('action') == 'create')
@can('create', new App\Classtype)
    <form method="POST" action="{{ route('classtypes.store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="form-label">{{ __('classtype.name') }} <span class="form-required">*</span></label>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
            {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('classtype.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input type="submit" value="{{ __('classtype.create') }}" class="btn btn-success">
        <a href="{{ route('classtypes.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
    </form>
@endcan
@endif
@if (Request::get('action') == 'edit' && $editableClasstype)
@can('update', $editableClasstype)
    <form method="POST" action="{{ route('classtypes.update', $editableClasstype) }}" accept-charset="UTF-8">
        {{ csrf_field() }} {{ method_field('patch') }}
        <div class="form-group">
            <label for="name" class="form-label">{{ __('classtype.name') }} <span class="form-required">*</span></label>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $editableClasstype->name) }}" required>
            {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('classtype.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $editableClasstype->description) }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input name="page" value="{{ request('page') }}" type="hidden">
        <input name="q" value="{{ request('q') }}" type="hidden">
        <input type="submit" value="{{ __('classtype.update') }}" class="btn btn-success">
        <a href="{{ route('classtypes.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        @can('delete', $editableClasstype)
            <a href="{{ route('classtypes.index', ['action' => 'delete', 'id' => $editableClasstype->id] + Request::only('page', 'q')) }}" id="del-classtype-{{ $editableClasstype->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
        @endcan
    </form>
@endcan
@endif
@if (Request::get('action') == 'delete' && $editableClasstype)
@can('delete', $editableClasstype)
    <div class="card">
        <div class="card-header">{{ __('classtype.delete') }}</div>
        <div class="card-body">
            <label class="form-label text-primary">{{ __('classtype.name') }}</label>
            <p>{{ $editableClasstype->name }}</p>
            <label class="form-label text-primary">{{ __('classtype.description') }}</label>
            <p>{{ $editableClasstype->description }}</p>
            {!! $errors->first('classtype_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <hr style="margin:0">
        <div class="card-body text-danger">{{ __('classtype.delete_confirm') }}</div>
        <div class="card-footer">
            <form method="POST" action="{{ route('classtypes.destroy', $editableClasstype) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                {{ csrf_field() }} {{ method_field('delete') }}
                <input name="classtype_id" type="hidden" value="{{ $editableClasstype->id }}">
                <input name="page" value="{{ request('page') }}" type="hidden">
                <input name="q" value="{{ request('q') }}" type="hidden">
                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
            </form>
            <a href="{{ route('classtypes.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        </div>
    </div>
@endcan
@endif
