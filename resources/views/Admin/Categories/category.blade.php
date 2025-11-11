@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>{{ __('Category') }}</h3>
                    <button id="add_category" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#category_modal">Add</button>
                </div>

                <div class="card-body justify-content-center">
                    <div class="table-responsive">
                        <table id="categoryTable" class="table table-striped table-bordered align-middle w-100">
                            <thead class="table-success">
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="category_form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Description:</label>
                        <input type="text" class="form-control" name="description">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#desciption_page').text('Category');

    document.getElementById('category_form').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);
        const token = document.querySelector('meta[name="csrf-token"]').content;

        try {
            const res = await fetch('Category/store', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await res.json();
            if (res.ok) {
                Swal.fire('Success', 'Category saved!', 'success');
                e.target.reset();

                const modal = bootstrap.Modal.getInstance(document.getElementById('category_modal'));
                modal.hide();
            } else {

                Swal.fire('Error', data.message || 'Failed to save category.', 'error');
            }
        } catch (err) {
            console.error('Catch error:', err);
        }
    });

    $(function() {
        const table = $('#categoryTable').DataTable({
            ajax: {
                url: "{{ route('categories.list') }}",
                dataSrc: 'data'
            },
            processing: true, // แสดง spinner ของ DataTables
            responsive: true,
            pageLength: 10,
            order: [
                [0, 'desc']
            ],
            columns: [
                { data: 'name' ,class:'text-center'},
                { data: 'description',render: (d) => d ?? '' ,class:'text-center'},
                { data: 'created_at',render: (d) => d ? new Date(d).toLocaleString() : '' ,class:'text-center'},
                { data: 'action' ,class:'text-center', orderable: false, searchable: false }
            ],
            language: {
                search: "Search:",
                lengthMenu: "แสดง _MENU_ แถว",
                info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                paginate: {
                    previous: "previous",
                    next: "next"
                },
                emptyTable: "ไม่มีข้อมูล"
            }
        });

    });
</script>
@endpush