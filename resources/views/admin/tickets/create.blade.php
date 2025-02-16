@extends('admin.layouts.adminlayout')

@section('style')
<style>
    /* Spinner styling */
    .spinner {
        border: 8px solid #16216867;
        border-radius: 50%;
        border-top: 8px solid #ffffff;
        width: 60px;
        height: 60px;
        animation: spin 2s linear infinite;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Background overlay styling */
    #loadingOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #16216867;
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>
@endsection


@section('main-content')

<!-- Start app main Content -->
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">

                <form id="ticketForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Ticket Form</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title">
                                <div class="text-danger" id="titleError"></div> <!-- Error message container -->
                            </div><br>

                            <div class="form-row">
                                <div>Select</div>
                                <select class="form-control" name="priority">
                                    <option selected disabled>select priority</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                                <div class="text-danger" id="priorityError"></div>
                            </div>

                            <div class="form-row mt-4">
                                <label>File Browser</label>
                                <div class="custom-file">
                                    <input type="file" name="attachment" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <div class="text-danger" id="attachmentError"></div>
                                </div>
                            </div><br>

                            <div class="form-row">
                                {{-- <div class="col-sm-12 col-md-7"> --}}
                                    <label class="">Description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                    <div class="text-danger" id="descriptionError"></div>
                                {{-- </div> --}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                            <a href="{{ route('tickets.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>

<div id="loadingOverlay" style="display:none;">
    <div class="spinner"></div>
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


@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    // $(document).ready(function() {
    //     // Handle form submission
    //     $('#ticketForm').on('submit', function(e) {
    //         e.preventDefault(); // Prevent form submission

    //         let formData = new FormData(this); // Capture form data including file

    //         // Clear previous errors
    //         $('#titleError').text('');
    //         $('#priorityError').text('');
    //         $('#attachmentError').text('');
    //         $('#descriptionError').text('');

    //         // Show loading overlay
    //         $('#loadingOverlay').show();

    //         $.ajax({
    //             url: "{{ route('tickets.store') }}", // Route to store method
    //             method: "POST"
    //             , data: formData
    //             , contentType: false, // For file upload
    //             processData: false, // Prevent jQuery from processing the data
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
    //             }
    //             , beforeSend: function() {
    //                 $('#submitButton').prop('disabled', true); // Disable submit button
    //             }
    //             , success: function(response) {
    //                 // Hide loading overlay
    //                 $('#loadingOverlay').hide();

    //                 if (response.success) {
    //                     // Redirect or display success message
    //                     window.location.href = "{{ route('tickets.index') }}"; // Redirect on success
    //                 }
    //             }
    //             , error: function(xhr) {
    //                 // Hide loading overlay
    //                 $('#loadingOverlay').hide();

    //                 // Enable submit button again
    //                 $('#submitButton').prop('disabled', false);

    //                 // Handle validation errors
    //                 if (xhr.status === 422) {
    //                     var errors = xhr.responseJSON.errors;
    //                     console.log(errors);
    //                     if (errors.title) {
    //                         $('#titleError').text(errors.title[0]);
    //                     }
    //                     if (errors.priority) {
    //                         $('#priorityError').text(errors.priority[0]);
    //                     }
    //                     if (errors.attachment) {
    //                         $('#attachmentError').text(errors.attachment[0]);
    //                     }
    //                     if (errors.description) {
    //                         $('#descriptionError').text(errors.description[0]);
    //                     }
    //                 }
    //             }
    //         });
    //     });
    // });



    $(document).ready(function() {
    // Handle form submission
    $('#ticketForm').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission

        let formData = new FormData(this); // Capture form data including file


        // Clear previous errors
        $('#titleError').text('');
        $('#priorityError').text('');
        $('#attachmentError').text('');
        $('#descriptionError').text('');

        // Show loading overlay
        $('#loadingOverlay').show();

        $.ajax({
            url: "{{ route('tickets.store') }}", // Route to store method
            method: "POST",
            data: formData,
            contentType: false, // For file upload
            processData: false, // Prevent jQuery from processing the data
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
            },
            beforeSend: function() {
                $('#submitButton').prop('disabled', true); // Disable submit button
            },
            success: function(response) {
                // Hide loading overlay
                $('#loadingOverlay').hide();

                if (response.success) {
                    // Redirect or display success message
                    window.location.href = "{{ route('tickets.index') }}"; // Redirect on success
                }
            },
            error: function(xhr) {
                // Hide loading overlay
                $('#loadingOverlay').hide();

                // Enable submit button again
                $('#submitButton').prop('disabled', false);

                // Handle validation errors
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    // console.log(errors); // Debugging

                    if (errors.title) {
                        $('#titleError').text(errors.title[0]);
                    }
                    if (errors.priority) {
                        $('#priorityError').text(errors.priority[0]);
                    }
                    if (errors.attachment) {
                        $('#attachmentError').text(errors.attachment[0]);
                    }
                    if (errors.description) {
                        $('#descriptionError').text(errors.description[0]);
                    }
                }
            }
        });
    });
});

</script>
@endsection
