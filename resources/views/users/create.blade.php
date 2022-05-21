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
    <div class="col-lg-10">
        <div class="card mb-3">
            <div class="card-header">
                <div class="row flex-between-end">
                    <div class="col-auto align-self-center">
                        <h5 class="mb-0" data-anchor="data-anchor">Register New Representative</h5>
                    </div>
                </div>
            </div>
            <div class="card-body bg-light">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Name" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email address</label>
                        <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="confirm-password">Password</label>
                        <input class="form-control" id="confirm-password" type="password" name="confirm-password" placeholder="Confirm Password" />
                    </div>
                    <div class="mb-3">
                        <select name="roles[]" class="d-none" id="roles">
                            <option value="Admin"></option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection