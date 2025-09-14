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
                <h3 class="card-title">Create Event</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Event Title</label>
                        <input type="text" id="exampleInputEmail1" class="form-control" name="title" placeholder="Enter Event Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Event Short Description</label>
                        <input type="text" class="form-control" name="short_des" id="exampleInputPassword1" placeholder="Short Description">
                    </div>
                    <div class="form-group">
                        <label for="description">Event Short Description</label>
                        <textarea id="description" class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group">
                  <label>Date range:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" name="date" class="form-control float-right" id="reservation">
                  </div>
                  <!-- /.input group -->
                </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Is Active</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="registration_open" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Start Registration</label>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
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
