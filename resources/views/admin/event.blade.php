@extends('layouts.admin_app')
@section('css')
{{-- <link rel="stylesheet" href="{{ asset('/css/summernote-bs4.min.css') }}"> --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection
@section('main')
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Event</h3>
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
            <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ isset($data) ? $data->id : '' }}">
                
                <div class="card-body">
                    <div class="form-group">
                        
                        <label for="category" class="form-label">Categories</label>
                         @php
                            $selectedCategories = explode(',', $categories ?? '');
                        @endphp
                    <select class="form-control select2" name="category[]" id="category" multiple="multiple">
                       

                        @foreach ($selectedCategories as $cat)
                            <option value="{{ $cat }}" selected>{{ $cat }}</option>
                        @endforeach
                    </select>
    
                       
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Event Title</label>
                        <input type="text" id="exampleInputEmail1" class="form-control" name="title" placeholder="Enter Event Title" value="{{ isset($data) ? $data->title : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="short_des">Event Short Description</label>
                        <input type="text" class="form-control" name="short_des" id="short_des" value="{{ isset($data) ? $data->short_des : '' }}" placeholder="Short Description">
                    </div>
                    <div class="form-group">
                        <label for="description">Event Description</label>
                        <textarea id="description" class="form-control" name="description">{!! isset($data) ? $data->description : '' !!}</textarea>
                    </div>
                    <div class="form-group">
                  <label>Date range:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" name="date" class="form-control float-right" id="reservation" value="{{ isset($data) ? $data->start_date.' - '.$data->end_date : '' }}">
                  </div>
                  <!-- /.input group -->
                </div>
                <div class="form-group">
                    <label for="image">Event Image</label>
                    <input type="file" class="form-control" name="file" id="file">
                    @if(isset($data) ? $data->banner_image : '')
                    <img src="{{ isset($data) ? asset($data->banner_image) : '' }}" alt="" width="100">
                    <input type="hidden" name="existing_image" value="{{ isset($data) ? $data->banner_image : '' }}">
                    @endif
                </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="exampleCheck1" {{ (isset($data) && $data->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="exampleCheck1">Is Active</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="registration_open" class="form-check-input" id="exampleCheck2" {{ (isset($data) && $data->registration_open) ? 'checked' : '' }}>
                        <label class="form-check-label" for="exampleCheck2">Start Registration</label>
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
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Is Active</th>
                            <th>Event Image</th>
                            <th>Registration Open</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($rows as $data)
                        <tr>
                            <td>{{ $data['title'] }}</td>
                            <td>{{ $data['short_des'] }}</td>
                            <td>{!! $data['description'] !!}</td>
                            <td>{{ $data['start_date'] }}</td>   
                            <td>{{ $data['end_date'] }}</td>
                            <td>{{ $data['is_active'] ? 'Yes' : 'No' }}</td>
                            <td>
                                @if ($data['banner_image'])
                                    <img src="{{ asset($data['banner_image']) }}" alt="Event Image" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td><a href="{{ route('event.status.update',$data['id']) }}"> {{ $data['registration_open'] ? 'Yes' : 'No' }}</a></td>
                            <td>
                                <a href="{{ route('event.update',$data['id']) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.event.delete',$data['id']) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                <a href="{{ route('view.participants',$data['id']) }}" class="btn btn-sm btn-primary">View Participants</a>
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {
    $('#category').select2({
        tags: true,              // ✅ Allows adding new values
        tokenSeparators: [','],  // ✅ Users can press comma to separate categories
        placeholder: "Select or add categories",
        width: '100%',
        createTag: function (params) {
            // ✅ Ensures empty values are not created
            var term = $.trim(params.term);
            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true // ✅ Mark as new tag
            };
        }
    });
});
</script>

@endsection
