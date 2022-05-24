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
                        <h5 class="mb-0">Create New User Group</h5>
                    </div>
                </div>
            </div>
            <div class="card-body bg-light">
                <form action="{{ route('create-group') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Name" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <input class="form-control" id="description" name="description" type="text" placeholder="Group Description" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="group-icon">Group Icon</label>
                        <input type="file" name="groupIcon" id="group-icon" class="form-control">
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="representatives">Select Representatives</label>
                        <select class="form-select js-choice" id="organizerMultiple" multiple="multiple" size="1" name="representatives[]" data-options='{"removeItemButton":true,"placeholder":true}'>
                            @foreach($representatives as $data)
                                <option value="{{ $data->id }}" {{ (in_array($data->id, $user_ids)) ? 'selected' : '' }} >{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="u_id1" value="{{ $user_ids[0] }}">
                    <input type="hidden" name="u_id2" value="{{ $user_ids[1] }}">

                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection