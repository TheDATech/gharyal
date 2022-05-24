@extends('layouts.app')
@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<div class="row g-3 mb-3">
    <div class="col-lg-12">
        <div class="card mb-3">
            <div class="card-header">
                <div class="row flex-between-end">
                    <div class="col-auto align-self-center">
                        <h5 class="mb-0" data-anchor="data-anchor">Edit Role</h5>
                    </div>
                </div>
            </div>
            <div class="card-body bg-light">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="name" value="{{ $role->name }}" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Permission:</strong>
                                @foreach($permission as $value)
                                    <div class="form-check">
                                        <input class="form-check-input" {{ @(in_array($value->id, $rolePermissions)) ? 'checked' : ''  }}  name="permission[]" value="{{ $value->id }}" id="flexCheckChecked_{{ $loop->index }}" type="checkbox"/>
                                        <label class="form-check-label" for="flexCheckChecked_{{ $loop->index }}">{{ $value->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection