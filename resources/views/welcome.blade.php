@extends('layouts.app')
@section('title', 'ยินดีต้อนรับ')
@section('meta_desc','Welcome to Seree Store')

@section('content')
<div class="container py-5">
  <h2 class="text-center mb-4">Our Products</h2>
  <div class="row g-4">
    @foreach($products as $product)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-success">{{ $product->name }}</h5>
            <p class="card-text flex-grow-1 text-muted small">{{ Str::limit($product->description, 80) }}</p>
            <div class="d-flex justify-content-between align-items-center mt-2">
              <span class="fw-bold text-dark">${{ number_format($product->price, 2) }}</span>
              <a href="" class="btn btn-sm btn-outline-success">View</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection