@extends('layouts.admin')
@push('styles')
@endpush
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-start">
                    <h3>{{ __('Dashboard') }}</h3>
                </div>

                <div class="card-body justify-content-center">
                    <div class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $('#desciption_page').text('Dashboard');
    </script>
@endpush