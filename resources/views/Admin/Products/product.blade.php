@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>{{ __('Product') }}</h3>
                    <button id="add_product" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#product_modal">Add</button>
                </div>

                <div class="card-body justify-content-center">
                    <div class="table-responsive">
                        <table id="productTable" class="table table-striped table-bordered align-middle w-100">
                            <thead class="table-success">
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">img</th>
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
<div class="modal fade" id="product_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="product_form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Name :</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Category :</label>
                        <select class="form-control" name="category_id" >
                            <option value="">เลือก Category</option>
                            @foreach($categories as $category )
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Description :</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Price :</label>
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">QTY :</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" name="price">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" name="qty">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Img :</label>
                        <input type="file" name="image" class="form-control">
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
    $('#desciption_page').text('Product');

    const table = $('#productTable').DataTable({
        ajax: {
            url: "{{ route('product.list') }}",
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
            { data: 'price' ,class:'text-center'},
            { data: 'qty' ,class:'text-center'},
            { data: 'category_name' ,class:'text-center'},
            {
                data: 'image',
                name: 'image',
                render: function (data, type, row) {
                    if (data) {
                        return `<img src="storage/${data}"  width="60" height="60" class="rounded">`;
                    }
                    return '<span class="text-muted">No image</span>';
                }
                ,class:'text-center'
            },
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

    document.getElementById('product_form').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);
        const token = document.querySelector('meta[name="csrf-token"]').content;

        try {
            const productStoreUrl = "{{ route('product.store') }}";
            const res = await fetch(productStoreUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await res.json();
            if (res.ok) {
                Swal.fire('Success', 'Products saved!', 'success');
                e.target.reset();

                const modal = bootstrap.Modal.getInstance(document.getElementById('product_modal'));
                modal.hide();
                table.ajax.reload(null, false);
            } else {

                Swal.fire('Error', data.message || 'Failed to save category.', 'error');
            }
        } catch (err) {
            console.error('Catch error:', err);
        }
    });
</script>
@endpush