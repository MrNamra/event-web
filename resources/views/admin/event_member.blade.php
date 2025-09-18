@extends('layouts.admin_app')
@section('css')
{{-- <link rel="stylesheet" href="{{ asset('/css/summernote-bs4.min.css') }}"> --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
@endsection
@section('main')
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Event Member</h3>
            </div>
            <div class="error-message">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="success-message">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('admin.event_member.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ isset($data) ? $data->id : '' }}">
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Team Name</label>
                        <input type="text" id="exampleInputEmail1" class="form-control" name="name" placeholder="Team Name" value="{{ isset($data) ? $data->name : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="role">Team Roll</label>
                        <input type="text" class="form-control" name="role" id="role" value="{{ isset($data) ? $data->role : '' }}" placeholder="Team Role">
                    </div>
                    <div class="form-group">
                        <label for="des">Team Description</label>
                        <textarea id="des" class="form-control" name="des">{!! isset($data) ? $data->des : '' !!}</textarea>
                    </div>
                 
                <div class="form-group">
                    <label for="image">Profile Image</label>
                    {{-- @php print_r($data); @endphp --}}
                    <input type="file" class="form-control" name="profile" id="profile">
                    @if(isset($data) ? $data->profile : '')
                    <img src="{{ isset($data) ? asset($data->profile) : '' }}" alt="" width="100">
                    <input type="hidden" name="existing_image" value="{{ isset($data) ? $data->profile : '' }}">
                    @endif
                </div>
                    
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-12">
                @if (isset($rows) && $rows->isNotEmpty())
                
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Description</th>
                            <th>Team Image</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($rows as $data)
                        <tr>
                            <td>{{ $data['name'] }}</td>
                            <td>{{ $data['role'] }}</td>
                            <td>{!! $data['des'] !!}</td>
                            <td>
                                @if ($data['profile'])
                                    <img src="{{ asset($data['profile']) }}" alt="Event Image" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('event_member.update',$data['id']) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{ route('admin.event_member.delete',$data['id']) }}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                            @endforeach
                        </tr>
                    </table>
                @endif
            </div>
        </div>
    </section>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
<script src="{{ asset('/js/moment.min.js') }}"></script>
<script src="{{ asset('/js/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote({ placeholder: "Enter full description here..." })
        $('#reservation').daterangepicker()
    })
    
</script>
@endsection
