@extends('layouts.app')
@section('content')

<div class="row g-3 mb-3">
    <div class="col-lg-12">
        <div class="card z-index-1">
            <div class="card-header border-bottom">
                <div class="row flex-between-center">
                    <div class="col-6 col-sm-auto d-flex align-items-center pe-0">
                        <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Representative list </h5>
                    </div>
                    <div class="col-6 col-sm-auto ms-auto text-end ps-0">
                        <div id="table-purchases-replace-element">
                            @can('role-create')
                            <a href="{{ route('users.create') }}">
                                <button class="btn btn-falcon-default btn-sm" type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">Create New User</span></button>
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped overflow-hidden">
                        <thead>
                            <tr class="btn-reveal-trigger">
                                <th scope="col">Representative Id</th>
                                <th scope="col">Representative Name</th>
                                <th scope="col">Representative Email</th>
                                <th class="text-end" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                            <tr class="btn-reveal-trigger">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-end">
                                    <div class="dropdown font-sans-serif position-static">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                                        <div class="dropdown-menu dropdown-menu-end border py-0">
                                            <div class="bg-white py-2">
                                                <a class="dropdown-item" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault();
                                                     document.getElementById('user-delete-form').submit();">Delete</a>
                                                <form action="{{ route('users.destroy',$user->id) }}" id="user-delete-form" method="DELETE">
                                                    @csrf
                                                    @method('DELTE')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection