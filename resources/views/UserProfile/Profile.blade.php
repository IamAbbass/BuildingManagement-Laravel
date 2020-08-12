@extends('layouts.admin')

@section('content')

<div class="container">
    
    <br>
    <div align="center">
        <h2>Update User Profile</h2>
        <br><br>
    <form action="/profile/{{$profile->id}}/update" method="post" style="width: 50%">
               @csrf
               {{-- @method('put') --}}
              <div class="form-group">
                <label for="">name</label>
                <input type="text"
              class="form-control" name="name" id="" value="{{$profile->name}}" aria-describedby="helpId" placeholder="">
              </div>

              <div class="form-group">
                <label for="">Email</label>
                <input type="text"
              class="form-control" name="email" id="" value="{{$profile->email}}" aria-describedby="helpId" placeholder="">
              </div>

              <div class="form-group">
                <label for="">Password</label>
                <input type="Password"
              class="form-control" name="password" id="" value="" aria-describedby="helpId" placeholder="">
              <input type="Password"
              class="form-control" name="oldpassword" id="" value="{{$profile->password}}" hidden aria-describedby="helpId" placeholder="">
              </div>

              <button type="submit" class="btn btn-primary">Update</button>
           </form>
     </div>

</div>

@endsection