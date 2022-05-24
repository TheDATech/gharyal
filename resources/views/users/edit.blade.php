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

<div class="row">
    <div class="col-12">
      <div class="card mb-3 btn-reveal-trigger">
        <div class="card-header position-relative min-vh-25 mb-8">
            <div class="cover-image">
                <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url(../../backend/assets/img/generic/4.jpg);">
                </div>
            </div>
            <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
                <div class="h-100 w-100 rounded-circle overflow-hidden position-relative"> 
                  @if($user->getFirstMediaUrl('avatars', 'thumb'))
                  <img src="{{ $user->getFirstMediaUrl('avatars', 'thumb') }}" width="200" alt="" data-dz-thumbnail="data-dz-thumbnail" />
                  @else
                  <img src="{{ asset('/backend/assets/img/team/avatar.png') }}" width="200" alt="" data-dz-thumbnail="data-dz-thumbnail" />
                  @endif
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row g-0">
    <div class="col-lg-8 pe-lg-2">
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="mb-0">Profile Settings</h5>
        </div>
        <div class="card-body bg-light">
          <form class="row g-3" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-lg-6">
                <label class="form-label" for="name">Name</label>
                <input class="form-control" id="name" value="{{ $user->name }}" name="name" type="text" />
            </div>
            <div class="col-lg-6">
                <label class="form-label" for="email">Email address</label>
                <input class="form-control" id="email" value="{{ $user->email }}" name="email" type="email" />
            </div>
            
            <div class="col-lg-6">
                <label class="form-label" for="phone">Phone</label>
                <input class="form-control" id="phone" name="phone" type="text" value="{{ $user->profile->phone ?? ''}}" />
            </div>
            <div class="col-lg-6">
                <label class="form-label" for="country">Country</label>
                <input class="form-control" id="country" value="{{ $user->profile->country ?? ''}}" name="country" type="text" />
            </div>
            <div class="col-lg-6">
                <label class="form-label" for="city">City</label>
                <input class="form-control" id="city" value="{{ $user->profile->city ?? ''}}" name="city" type="city" />
            </div>
            <div class="col-lg-6">
                <label class="form-label" for="zipcode">Zipcode</label>
                <input class="form-control" id="zipcode" value="{{ $user->profile->zipcode ?? '' }}" name="zipcode" type="text" />
            </div>
            <div class="col-lg-12">
                <label class="form-label" for="address">Full address</label>
                <input class="form-control" id="address" value="{{ $user->profile->address ?? '' }}" name="address" type="text" />
            </div>
            <div class="col-lg-12">
                <select name="roles[]" class="d-none" id="roles" multiple>
                    @foreach($user->roles as $role)
                        <option value="{{ $role->id }}" selected> {{ $role->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-12">
                <label class="form-label" for="avatar">Profile</label>
                <input type="file" name="avatar" id="avatar" class="form-control">
            </div>
            <!-- <div class="col-lg-12">
                <div class="dropzone dropzone-single p-0" data-dropzone="data-dropzone" data-options='{"url":"valid/url","maxFiles":1,"dictDefaultMessage":"Choose or Drop a file here"}'>
                    <div class="fallback">
                        <input type="file" name="avatar" />
                    </div>
                    <div class="dz-preview dz-preview-single">
                        <div class="dz-preview-cover dz-complete"><img class="dz-preview-img" src="{{ asset('backend/assets/img/generic/image-file-2.png') }}" alt="..." data-dz-thumbnail="" /><a class="dz-remove text-danger" href="#!" data-dz-remove="data-dz-remove"><span class="fas fa-times"></span></a>
                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                        <div class="dz-errormessage m-1"><span data-dz-errormessage="data-dz-errormessage"></span></div>
                        </div>
                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                    </div>
                    <div class="dz-message" data-dz-message="data-dz-message">
                        <div class="dz-message-text"><img class="me-2" src="{{ asset('backend/assets/img/icons/cloud-upload.svg') }}" width="25" alt="" />Drop your file here</div>
                    </div>
                </div>
            </div> -->
            <div class="col-12 d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">Update </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-4 ps-lg-2">
      <div class="sticky-sidebar">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Change Password</h5>
            </div>
            <div class="card-body bg-light">
                <form class="row g-3" action="{{ route('update_password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="current-password">Current Password</label>
                        <input class="form-control" id="current-password" name="current_password" type="password" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">New Password</label>
                        <input class="form-control" id="password" name="password" type="password" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="confirm-password">Confirm Password</label>
                        <input class="form-control" id="confirm-password" type="password" name="confirm_password" />
                    </div>

                    <button class="btn btn-primary d-block w-100" type="submit">Update Password </button>
                </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Danger Zone</h5>
          </div>
          <div class="card-body bg-light">
            <h5 class="fs-0">Delete this account</h5>
            <p class="fs--1">Once you delete a account, there is no going back. Please be certain.</p><a class="btn btn-falcon-danger d-block" href="#!">Deactivate Account</a>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection