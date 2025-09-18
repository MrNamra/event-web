@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="registration-section">
    <div class="container">

        {{-- Laravel Flash Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Laravel Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> Please fix the errors below.
            </div>
        @endif

        <div class="registration-container">
            @if($event->registration_open == 1)
                <div class="registration-header">
                    <h1 class="registration-title">{{ $event->name }}</h1>
                    <p class="registration-subtitle">Register your team for the most exciting hackathon of the year!</p>
                </div>

                <form id="eventRegisterForm" class="registration-form" method="POST" action="{{ route('event.register.submit') }}">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <div class="form-section">
                        <h2 class="form-section-title">
                            <i class="fas fa-list"></i>
                            Category Selection
                        </h2>
                        <div class="form-group">
                            <label for="category_id">Category *</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-section">
                        <h2 class="form-section-title">
                            <i class="fas fa-users"></i>
                            Team Information
                        </h2>
                        <div class="form-group">
                            <label for="team_name">Team Name</label>
                            <input type="text" class="form-control @error('team_name') is-invalid @enderror" id="team_name" name="team_name" value="{{ old('team_name') }}">
                            @error('team_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="team_size">Team Type *</label>
                            <select class="form-control @error('team_size') is-invalid @enderror" id="team_size" name="team_size" required>
                                <option value="">Select Team Type</option>
                                <option value="1" {{ old('team_size') == '1' ? 'selected' : '' }}>Solo</option>
                                <option value="2" {{ old('team_size') == '2' ? 'selected' : '' }}>Team</option>
                            </select>
                            @error('team_size')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" id="team_number_group" style="display: {{ old('team_size') == '2' ? 'block' : 'none' }}">
                            <label for="team_number">Number of Team Members *</label>
                            <select class="form-control @error('team_number') is-invalid @enderror" id="team_number" name="team_number">
                                <option value="">Select Number</option>
                                @for($i = 1; $i < 7; $i++)
                                    <option value="{{ $i+1 }}" {{ old('team_number') == ($i+1) ? 'selected' : '' }}>{{ $i+1 }} Members</option>
                                @endfor
                            </select>
                            @error('team_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="team-members" id="team_members_section">
                        @if(old('name'))
                            @foreach(old('name') as $index => $name)
                                <div class="member-form">
                                    <h3 class="member-title"><i class="fas fa-user"></i> Team Member {{ $index + 1 }}</h3>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Name *</label>
                                            <input type="text" class="form-control" name="name[]" value="{{ $name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Contact No. *</label>
                                            <input type="text" class="form-control" name="contact_number[]" value="{{ old('contact_number')[$index] ?? '' }}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Email *</label>
                                            <input type="email" class="form-control" name="email[]" value="{{ old('email')[$index] ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Class/Stream *</label>
                                            <input type="text" class="form-control" name="class[]" value="{{ old('class')[$index] ?? '' }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Division *</label>
                                        <input type="text" class="form-control" name="division[]" value="{{ old('division')[$index] ?? '' }}" required>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            Submit Registration
                        </button>
                    </div>
                </form>
            @else
                <div class="registration-closed">
                    <h2>Registration Closed</h2>
                    <p>We're sorry, but the registration for this event is currently closed. Please check back later for updates.</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        const oldTeamSize = "{{ old('team_size') }}";
        const oldTeamNumber = "{{ old('team_number') }}";

        if (oldTeamSize === '2') {
            $('#team_number_group').show();
        }

        $('#team_size').change(function () {
            const teamSize = $(this).val();
            if (teamSize === '2') {
                $('#team_number_group').show();
            } else {
                $('#team_number_group').hide();
                generateTeamMemberFields(1);
                $('#team_members_section').show();
            }
        });

        $('#team_number').change(function () {
            const teamNumber = parseInt($(this).val());
            if (teamNumber > 0) {
                generateTeamMemberFields(teamNumber);
                $('#team_members_section').show();
            } else {
                $('#team_members_section').hide();
            }
        });

        function generateTeamMemberFields(teamNumber) {
            let html = '';
            for (let i = 0; i < teamNumber; i++) {
                html += `
                    <div class="member-form">
                        <h3 class="member-title"><i class="fas fa-user"></i> Team Member ${i + 1}</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" class="form-control" name="name[]" required>
                            </div>
                            <div class="form-group">
                                <label>Contact No. *</label>
                                <input type="text" class="form-control" name="contact_number[]" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" class="form-control" name="email[]" required>
                            </div>
                            <div class="form-group">
                                <label>Division *</label>
                                <input type="text" class="form-control" name="division[]" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Class *</label>
                            <input type="text" class="form-control" name="class[]" required>
                        </div>
                    </div>
                `;
            }
            $('#team_members_section').html(html);
        }
    });
</script>
@endsection
