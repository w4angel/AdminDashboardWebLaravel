@extends('layouts.master')


@section('title')
Dashboard | Admin Dashboard Web by Susan
@endsection

@section('content')
<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Dashboard</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class='table'>
                    <thead class=" text-primary">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Profile Picture</th>
                    </thead>
                    <tbody>
                      @foreach ($users as $row )
                      <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->email }}</td>
                      <td>
                        @if($row->image !== null)
                          <img src="{{ url('storage/images/' .trim($row->image)) }}" alt="" style="width:100px; height:100px;">
                      @else
                          <img src="{{ asset('storage/images/default-avatar.png') }}" alt="" style="width:100px; height:100px;">
                      @endif
                      </td>
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

@endsection

