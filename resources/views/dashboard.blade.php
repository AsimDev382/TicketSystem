@extends('admin.layouts.adminlayout')
@section('main-content')

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                {{-- <div class="section-header"> --}}
                    <h2>Dashboard</h2>
                    {{-- <a href="{{ route('send.email') }}" class="btn btn-danger">Send Email</a> --}}
                {{-- </div> --}} <br>
                <div class="row">

                    @if(session('success'))
                        <div class="alert alert-success">{{ $success }}</div>
                    @endif

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total tickets</h4>
                                </div>
                                <div class="card-body">
                                    {{ $total_ticket->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Resolved tickets</h4>
                                </div>
                                <div class="card-body">
                                    {{ $total_r->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pending tickets</h4>
                                </div>
                                <div class="card-body">
                                    {{ $total_p->count() }}
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
                 <div class="bullet"></div>  <a href="templateshub.net">Templates Hub</a>
            </div>
            <div class="footer-right">

            </div>
        </footer>



    </div>
</div>

@endsection
