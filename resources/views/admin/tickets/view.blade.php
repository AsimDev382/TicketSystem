@extends('admin.layouts.adminlayout')
@section('main-content')

<!-- Start app main Content -->
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <form action="" method="">
                    @csrf
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
                                @if($ticket->attachment)
                                <label>File Browser</label>
                                <div class="custom-file">
                                    <img src="{{ asset('attachments/'. $ticket->attachment) }}"  width="55" data-toggle="tooltip">
                                </div>
                                @endif
                            </div>

                            <div class="form-row mt-4">
                                <label class="col-12 col-md-3 col-lg-3">Description</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea name="description" readonly class="summernote">{{ $ticket->description }}</textarea>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('tickets.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
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
