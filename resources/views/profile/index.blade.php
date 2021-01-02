@extends('layouts.admin')
@section('content')
<div class="container-fluid">  
    <div class="row">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header">
            <h1 class="h3 text-gray-800">Profile</h1>
          </div>
          <div class="card-body">
            <form action="/profile" method="POST">
              @csrf
              <div class="form-group">
                <label for="company_name">Name:</label>
                <input required type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Enter name">
              </div>
              <div class="form-group">
                <label for="company_name">Email:</label>
                <input required type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Enter email">
              </div>
              <div class="form-group ml-2">
                <button type="submit" class="btn btn-success btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                  </span>
                  <span class="text">Save Profile</span>
                </button>
              </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header">
          <h1 class="h3 text-gray-800">Change Password</h1>
        </div>
        <div class="card-body">
          <form action="/profile" method="POST">
            @csrf
            <div class="form-group">
              <label for="company_name">Current Password:</label>
              <input required type="password" name="old_password" class="form-control" value=""placeholder="Enter old password">
            </div>
            <div class="form-group">
              <label for="company_name">New Password:</label>
              <input required type="password" name="new_password" class="form-control" value="" placeholder="Enter new password">
            </div>
            <div class="form-group">
              <label for="company_name">Re-type new Password:</label>

              <input required type="password" name="confirm_new_password" class="form-control" value="" placeholder="re-type new Password">
            </div>
            <div class="form-group ml-2">
              <button type="submit" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-check"></i>
                </span>
                <span class="text">Update Password</span>
              </button>
            </div>
        </form>
      </div>
    </div>
    
  </div>

    
  </div>

  
</div>
@endsection