@extends('layouts.admin_app')
@section('css')
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('main')
<body class="p-4">
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
        </div>
        <div class="row">
            <div class="col-12">
    @if(isset($participants) && $participants->isNotEmpty())
        <table id="participantsTable" class="table table-bordered">
            <thead>
            <tr>
                <th>Team Name</th>
                <th>Team Members</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Class</th>
                <th>Division</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($participants as $registration)
                @php
                    // $teamCount = $registration->team->count(); // count team members
                @endphp

                @foreach ($registration->team as $index => $team_member)
                    <tr>
                        {{-- Show team name only for first member with rowspan --}}
                        {{-- @if ($index === 0) --}}
                            <td>{{ $registration->team_name }}</td>
                        {{-- @endif --}}

                        <td>{{ $team_member->name }}</td>
                        <td>{{ $team_member->email }}</td>
                        <td>{{ $team_member->contact_number }}</td>
                        <td>{{ $team_member->class }}</td>
                        <td>{{ $team_member->division }}</td>
                        <td>{{ $team_member->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    @endif
</div>

        </div>
    </section>
@endsection
@section('js')
    <!-- jQuery must be loaded first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle (optional for styling) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Buttons Extension -->
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script>
        $(document).ready(function() {
            $('#participantsTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Download Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'Download CSV',
                        className: 'btn btn-primary'
                    }
                ]
            });
        });
    </script>

@endsection
</body>
