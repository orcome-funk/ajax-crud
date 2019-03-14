@extends('layouts.app')

@section('title', __('classtype.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Classtype)
            <a href="{{ route('classtypes.index', ['action' => 'create']) }}" class="btn btn-success">{{ __('classtype.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('classtype.list') }} <small>{{ __('app.total') }} : {{ $classtypes->total() }} {{ __('classtype.classtype') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('classtype.search') }}</label>
                        <input placeholder="{{ __('classtype.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('classtype.search') }}" class="btn btn-secondary">
                    <a href="{{ route('classtypes.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('classtype.name') }}</th>
                        <th>{{ __('classtype.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classtypes as $key => $classtype)
                    <tr>
                        <td class="text-center">{{ $classtypes->firstItem() + $key }}</td>
                        <td>{{ $classtype->name }}</td>
                        <td>{{ $classtype->description }}</td>
                        <td class="text-center">
                            @can('update', $classtype)
                                <a href="{{ route('classtypes.index', ['action' => 'edit', 'id' => $classtype->id] + Request::only('page', 'q')) }}" id="edit-classtype-{{ $classtype->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $classtypes->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
        @include('classtypes.forms')
        @endif
    </div>
</div>
@endsection
