@extends('layouts.admin')
@push('styles')
@endpush
@section('content')

<div class="panel-body bg-light p-2">
    <table id="myTable">
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
                <th>Column 3</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Data 1a</td>
                <td>Data 2a</td>
                <td>Data 3a</td>
            </tr>
            <tr>
                <td>Data 1b</td>
                <td>Data 2b</td>
                <td>Data 3b</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
@push('scripts')
    <script>
        $('#desciption_page').text('Dashboard');
    </script>
@endpush