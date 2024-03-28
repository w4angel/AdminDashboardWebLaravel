@extends('layouts.master')


@section('title')
User Details
@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="exampleModalLabel">Create New User</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/save-aboutus" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="modal-body">

            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Name</label>
              <input id="name" type="text" placeholder="John Dune" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Phone Number</label>
                <input id="phone" type="text" placeholder="eg MY: +60111234567 , a valid phone number" class="form-control  @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Email</label>
                <input id="email" type="email" placeholder="someone@example.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
              </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Address</label>
              <textarea name="address" type="text" placeholder="Metrocity" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address"></textarea>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Password</label>
              <input id="password" type="password" placeholder="min 8 characters" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>
           {{--}} <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Profile Picture</label>
              <input type="file" id="image" name="image">
            </div> --}}

          <div class="mb-3">
              <label for="image">Profile Picture</label>
              <input type="file" name="image" class="form-control" @error('image') is-invalid @enderror>
            @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">SAVE</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  {{-- Delete Modal --}}
  <!-- Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-3" id="exampleModalLabel">Delete Data</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="delete_modal_Form" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
      
     
      <div class="modal-body">
        <input type="hidden" id="delete_aboutus_id">
        <h7>Are you sure? Do you want to delete this account ?</h7>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Yes. Delete It.</button>
      </div>
    </form>
    </div>
  </div>
</div>
{{-- End - Delete Modal --}}
<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Registered User
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">Add  New User</button>
            </h4>
          
                    <style>
                      .w-10p{
                        width: 10% !important;
                      }
                    </style>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="myTable" class='table table-stripped'>
                    <thead class=" text-primary">
                      <th class="w-10p">Id</th>
                      <th class="w-10p">Name</th>
                      <th class="w-10p">Phone</th>
                      <th class="w-10p">Email</th>
                      <th class="w-10p">Address</th>
                      <th class="w-10p">Profile Picture</th>
                      <th class="w-10p">Edit</th>
                      <th class="w-10p">Delete</th>
                    </thead>
                    <tbody>
                      @foreach ($aboutus as $data)     
                      <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>/
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->email }}</td>
                        <td><div style="height:80px; overflow: hidden;"> {{ $data->address }}</div></td>
                        <td>
                          @if($data->image !== null)
                          <img src="{{ url('storage/images/' .trim($data->image)) }}" alt="" style="width:100px; height:100px;">
                      @else
                          <img src="{{ asset('storage/images/default-avatar.png') }}" alt="" style="width:100px; height:100px;">
                      @endif
                      </td>
                      <td>
                            <a href="{{ url('about-us/'.$data->id) }}" class="btn btn-success">EDIT</a>
                        </td>
                        <td>
                          <a href="javascript:void(0)" class="btn btn-danger deletebtn">DELETE</a>
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

@section('scripts')
<script>
  let table = new DataTable('#myTable');

  $('#myTable').on('click', '.deletebtn', function(){
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function (){
      return $(this).text();
    }).get();

    //console.log(data);

    $('#delete_aboutus_id').val(data[0]);

    $('#delete_modal_Form').attr('action', '/about-us-delete/'+data[0]);

    $('#deletemodalpop').modal('show');
  });
</script>

@endsection

