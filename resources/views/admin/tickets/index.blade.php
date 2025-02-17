@extends('admin.layouts.adminlayout')

@section('style')
<style>
#tickets-list {
    margin-top: 20px;
}

.ticket {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
}
</style>
@endsection

@section('main-content')

<!-- Start app main Content -->



<div class="main-content">


    <div class="d-flex">
        <select name="status" class="form-control w-25" id="status-filter">
            <option value="">Select Status</option>
            <option value="Open">Open</option>
            <option value="In Progress">In Progress</option>
            <option value="Resolved">Resolved</option>
            <option value="Closed">Closed</option>
        </select>&nbsp;

        <select name="priority" class="form-control w-25" id="priority-filter">
            <option value="">Select Priority</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>&nbsp;

        <input type="date" name="date" class="form-control w-25" id="date-filter">
    </div>


    <section class="section">

        <div class="row">

            @if(session('success'))
                <div class="alert alert-success w-100">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Add this div to show the success message -->
            <div id="success-message" class="alert alert-success w-100" style="display: none;"></div>


            <div class="col-12">
                <div style="position: relative; left:920px; bottom:5px;">
                    <a href="{{ route('tickets.create') }}" class="btn btn-success">Create</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>All Tickets</h4>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped v_center" id="table-2">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($tickets as $ticket)
                                    <tr>
                                        <td class="text-center">{{ $ticket->id }}</td>
                                        <td>{{ $ticket->title }}</td>
                                        <td>{{ $ticket->priority }}</td>
                                        <td>
                                            @if(auth()->user()->role == 'admin')
                                                <form method="POST" action="{{ route('tickets.updateStatus', $ticket) }}">
                                                    @csrf
                                                    <div class="d-flex">
                                                    <select name="status" class="form-control" style="width: 150px">
                                                        <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                                                        <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="Resolved" {{ $ticket->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                                        <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                                    </select> &nbsp;
                                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                                                </div>
                                                </form>
                                            @endif
                                            @if(auth()->user()->role == 'user')
                                                <form method="POST" action="{{ route('tickets.updateStatus', $ticket) }}">
                                                    @csrf
                                                    <div class="d-flex">
                                                    <select name="status" class="form-control" style="width: 150px">
                                                        <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                                                        {{-- <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="Resolved" {{ $ticket->status == 'Resolved' ? 'selected' : '' }}>Resolved</option> --}}
                                                        <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                                    </select> &nbsp;
                                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                                                </div>
                                                </form>
                                            @endif
                                        </td>
                                        <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-warning">View</a>
                                            @if(auth()->user()->role == 'admin')
                                            <form action="{{ route('tickets.destroy', $ticket->id) }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                            @endif
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
    </section>
</div>

<!-- Start app Footer part -->

<footer class="main-footer">
    <div class="footer-left">
        <div class="bullet"></div> <a href="templateshub.net">Templates Hub</a>
    </div>
    <div class="footer-right">

    </div>
</footer>



</div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('script')
<script>
$(document).ready(function() {
    // Trigger the filter function whenever any of the filters are changed
    $('#status-filter, #priority-filter, #date-filter').on('change', function() {
        filterTickets();
    });

    function filterTickets() {
        // Get values of selected filters
        var status = $('#status-filter').val();
        var priority = $('#priority-filter').val();
        var date = $('#date-filter').val();

        // Make AJAX request to server to filter tickets
        $.ajax({
            url: '{{ route("filter.tickets") }}', // The route to the filter method
            type: 'GET',
            data: {
                status: status,
                priority: priority,
                date: date
            },
            success: function(response) {
                // Clear the current ticket list
                $('#table-2 tbody').empty();

                // Append the filtered tickets to the list
                if (response.length > 0) {
                    $.each(response, function(index, ticket) {
                        var statusOptions = '';
                        var role = "{{ auth()->user()->role }}";

                        if (role === 'admin') {
                            statusOptions = `<select name="status" class="form-control" style="width: 150px">
                                                <option value="Open" ${ticket.status == 'Open' ? 'selected' : ''}>Open</option>
                                                <option value="In Progress" ${ticket.status == 'In Progress' ? 'selected' : ''}>In Progress</option>
                                                <option value="Resolved" ${ticket.status == 'Resolved' ? 'selected' : ''}>Resolved</option>
                                                <option value="Closed" ${ticket.status == 'Closed' ? 'selected' : ''}>Closed</option>
                                            </select>`;
                        } else {
                            statusOptions = `<select name="status" class="form-control" style="width: 150px">
                                                <option value="Open" ${ticket.status == 'Open' ? 'selected' : ''}>Open</option>
                                                <option value="Closed" ${ticket.status == 'Closed' ? 'selected' : ''}>Closed</option>
                                            </select>`;
                        }

                        $('#table-2 tbody').append(`
                            <tr>
                                <td class="text-center">${ticket.id}</td>
                                <td>${ticket.title}</td>
                                <td>${ticket.priority}</td>
                                <td>
                                    <form method="POST" action="/tickets/${ticket.id}/status">
                                        @csrf
                                        <div class="d-flex">
                                            ${statusOptions} &nbsp;
                                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                                        </div>
                                    </form>
                                </td>
                                <td>${new Date(ticket.created_at).toLocaleDateString("es-CL")}</td>
                                <td>
                                    <a href="/tickets/${ticket.id}" class="btn btn-warning">View</a>
                                    ${role === 'admin' ? `<a href="/tickets/${ticket.id}/destroy" class="btn btn-danger">Delete</a>` : ''}
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#table-2 tbody').append('<tr><td colspan="6" class="text-center">No tickets found.</td></tr>');
                }
            }
        });
    }
});

    </script>
    @endsection
