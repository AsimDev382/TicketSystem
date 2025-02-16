@extends('admin.layouts.adminlayout')

@section('style')
<style>
    /* Spinner CSS */
    .spinner {
        border: 8px solid #16216867;
        border-radius: 50%;
        border-top: 8px solid white;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

</style>
@endsection

@section('main-content')
<!-- Start app main Content -->
<div class="main-content">
    <section class="section">

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ticket Show</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <label for="">Title</label>
                            <input type="text" name="title" value="{{ $ticket->title }}" readonly class="form-control" placeholder="Title">
                        </div>

                        <div class="form-row mt-4">
                            <div>Priority</div>
                            <select class="custom-select" name="user_id">
                                <option value="{{ $ticket->priority }}" selected hidden>{{ $ticket->priority }}</option>
                            </select>
                        </div>
                        <div class="form-row mt-4">
                            <div>Status</div>
                            <input type="text" name="status" value="{{ $ticket->status }}" class="form-control" readonly>
                        </div>


                        <div class="form-row mt-4">
                            <label>File Browser</label>
                            @if ($ticket->attachment)
                            <img src="{{ asset('storage/' . $ticket->attachment) }}" alt="Attachment" width="50">
                            @else
                            <p>No attachment</p>
                            @endif
                        </div>

                        <div class="form-row mt-4">
                            <label class="">Description</label>
                            <div class="col-sm-12 col-md-12 ">
                                <textarea name="description" readonly class="form-control">{{ $ticket->description }}</textarea>
                            </div>

                        </div><br>
                        <hr>

                        @if(session('success'))
                        <div class="alert alert-success w-100">
                            {{ session('success') }}
                        </div>
                        @endif


                        <h3>Replies</h3>

                        <div id="repliesContainer">
                            @foreach($ticket->replies as $reply)
                            <div class="reply">
                                <strong>{{ $reply->user->name }}</strong> ({{ $reply->created_at->diffForHumans() }}):
                                <p>{{ $reply->message }}</p>
                            </div>
                            @endforeach
                        </div>

                        @if(Auth::check())
                        <form id="replyForm">
                            @csrf
                            <div class="form-group">
                                <label for="message">Your Reply:</label>
                                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                                <span id="messageError" class="text-danger"></span>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Reply</button>
                        </form>
                        @endif
                    </div>
                </div>


                <div class="card-footer">
                    <a href="{{ route('tickets.index') }}" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 9999;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="spinner"></div>
    </div>
</div>


<!-- Start app Footer part -->
<footer class="main-footer">
    <div class="footer-left">
        <div class="bullet"></div> <a href="templateshub.net">Templates Hub</a>
    </div>
    <div class="footer-right">

    </div>
</footer>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // $(document).ready(function () {
    //     $('#replyForm').on('submit', function (e) {
    //         e.preventDefault(); // Prevent form submission

    //         let formData = {
    //             message: $('#message').val(),
    //             _token: $('input[name="_token"]').val()
    //         };

    //         // Clear previous error
    //         $('#messageError').text('');

    //         // Show loading overlay
    //         $('#loadingOverlay').show();

    //         $.ajax({
    //             url: "{{ route('replies.store', $ticket->id) }}", // Route to store method
    //             method: "POST",
    //             data: formData,
    //             beforeSend: function () {
    //                 // Disable the submit button
    //                 $('#replyForm button').prop('disabled', true);
    //                 // Show the loading overlay
    //                 $('#loadingOverlay').show();
    //             },
    //             success: function (response) {
    //                 // Hide loading overlay
    //                 $('#loadingOverlay').hide();

    //                 if (response.success) {
    //                     // Append new reply to the replies container
    //                     $('#repliesContainer').append(`
    //                         <div class="reply">
    //                             <strong>${response.user.name}</strong> (${response.reply.created_at}):
    //                             <p>${response.reply.message}</p>
    //                         </div>
    //                     `);

    //                     // Show success message
    //                     $('#successMessageContainer').html(`
    //                         <div class="alert alert-success w-100">
    //                             ${response.reply.success}
    //                         </div>
    //                     `);

    //                     // Clear the textarea
    //                     $('#message').val('');
    //                 }
    //             },
    //             error: function (xhr) {
    //                 // Hide loading overlay
    //                 $('#loadingOverlay').hide();

    //                 // Handle validation errors
    //                 if (xhr.status === 422) {
    //                     var errors = xhr.responseJSON.errors;
    //                     if (errors.message) {
    //                         $('#messageError').text(errors.message[0]);
    //                     }
    //                 }
    //             },
    //             complete: function () {
    //                 // Enable the submit button
    //                 $('#replyForm button').prop('disabled', false);
    //                 // Hide the loading overlay
    //                 $('#loadingOverlay').hide();
    //             }
    //         });
    //     });
    // });


    $(document).ready(function() {
        $('#replyForm').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission

            let formData = {
                message: $('#message').val()
                , _token: $('input[name="_token"]').val()
            };


            // Clear previous error
            $('#messageError').text('');

            // Show loading overlay
            $('#loadingOverlay').show();

            $.ajax({
                url: "{{ route('replies.store', $ticket->id) }}", // Route to store method
                method: "POST"
                , data: formData
                , beforeSend: function() {
                    // Disable the submit button
                    $('#replyForm button').prop('disabled', true);
                    // Show the loading overlay
                    $('#loadingOverlay').show();
                }
                , success: function(response) {
                    // Hide loading overlay
                    $('#loadingOverlay').hide();

                    if (response.success) {
                        // Append new reply to the replies container
                        $('#repliesContainer').append(
                            `<div class="reply">
                                <strong>${response.user.name}</strong> (${response.reply.created_at}):
                                <p>${response.reply.message}</p>
                            </div>`
                        );
                        // Clear the textarea
                        $('#message').val('');
                    }
                }
                , error: function(xhr) {
                    // Hide loading overlay
                    $('#loadingOverlay').hide();

                    // Handle validation errors
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        if (errors.message) {
                            $('#messageError').text(errors.message[0]);
                        }
                    }
                }
                , complete: function() {
                    // Enable the submit button
                    $('#replyForm button').prop('disabled', false);
                    // Hide the loading overlay
                    $('#loadingOverlay').hide();
                }
            });
        });
    });

</script>
@endsection
