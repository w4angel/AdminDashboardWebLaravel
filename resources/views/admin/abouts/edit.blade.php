@extends('layouts.master')


@section('title')
Edit User Details
@endsection

@section('content')

<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                 <h4 class="card-title">Edit User Details</h4>
            </div>

                <div class="card-body">
                    <form action="{{ url('aboutus-update/'.$aboutus->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row">
                            <div class="col-md-10">
                      <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $aboutus->name }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                        <label>Phone</label>
                          <input type="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $aboutus->phone }}" required autocomplete="phone" autofocus>
                          @error('phone')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                        <label>Email</label>
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $aboutus->email }}" required autocomplete="email">
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                      <label>Address</label>
                      <textarea name="address" class="form-control" rows="6" cols="5" >{{ $aboutus->address }}</textarea>
                      @error('address')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                            <label for="image">Profile Picture</label>
                                <input type="file" class="form-control" name="image">
                                @if($aboutus->image)
                                    <img src="{{ asset('storage/images/'.$aboutus->image) }}" style="height: 100px;width:100px; margin-top:5px;">
                                @else 
                                    <span>No image</span>
                                @endif
                            </div>
                        </div>
                            
                        </div>
                            </div>
                            </div>
                        </div>

                <div class="modal-footer">
                  <a href="{{ url('abouts') }}" class="btn btn-secondary">BACK</a>
                  <button type="submit" class="btn btn-primary">UPDATE</button>
                </div>
            </form>
@endsection