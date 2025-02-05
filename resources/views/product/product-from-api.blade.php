@extends('layouts.master')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Products</h3>
                <p class="text-subtitle text-muted">Display all product data from api</p>
                <p class="text-subtitle text-muted">Discount Pop-up double click row</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Products
            </div>
            <div class="card-body">
                <form method="GET" action="{{ url()->current() }}"> 
                    <div class="row">
                        <div class="col-md-3">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">Select Status</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Approved</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Not Approved</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="type" class="form-select" onchange="this.form.submit()">
                                <option value="">Select Type</option>
                                <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Food & Baverages</option>
                                <option value="2" {{ request('type') == '2' ? 'selected' : '' }}>Pharmaceuticals</option>
                                <option value="2" {{ request('type') == '3' ? 'selected' : '' }}>Government</option>
                                <option value="2" {{ request('type') == '4' ? 'selected' : '' }}>Traditional Medicine & Suplement</option>
                                <option value="2" {{ request('type') == '13' ? 'selected' : '' }}>Beauty, Cosmetics & Personal Care</option>
                                <option value="2" {{ request('type') == '14' ? 'selected' : '' }}>Media RTU</option>
                                <option value="2" {{ request('type') == '15' ? 'selected' : '' }}>K3L Products</option>
                                <option value="2" {{ request('type') == '16' ? 'selected' : '' }}>ALKES & PKRT</option>
                                <option value="2" {{ request('type') == '17' ? 'selected' : '' }}>Feed, Pesticides & PSAT</option>
                                <option value="2" {{ request('type') == '18' ? 'selected' : '' }}>Others</option>
                                <option value="2" {{ request('type') == '19' ? 'selected' : '' }}>Research / Academic Purpose</option>
                                <option value="2" {{ request('type') == '20' ? 'selected' : '' }}>Dioxine Udara</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="attachment" class="form-select" onchange="this.form.submit()">
                                <option value="">Select Attachment</option>
                                <option value="1" {{ request('attachment') == '1' ? 'selected' : '' }}>Exist</option>
                                <option value="0" {{ request('attachment') == '0' ? 'selected' : '' }}>Not Exist</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="discount" class="form-select" onchange="this.form.submit()">
                                <option value="">Select Discount</option>
                                <option value="1" {{ request('discount') == '1' ? 'selected' : '' }}>Discount</option>
                                <option value="0" {{ request('discount') == '0' ? 'selected' : '' }}>Not Discount</option>
                            </select>
                        </div>
                    </div>
                </form>
                <br>

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                        <tr data-bs-toggle="modal" data-bs-target="#discountModal{{ $product->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ App\ProductType::from($product->type)->alias() }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                @if ($product->status == 1)
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-secondary">Not Yet Approved</span>
                                @endif
                            </td>
                            <td>IDR {{ number_format($product->price) }}</td>
                            <td>IDR {{ number_format($product->discount) }}</td>
                            @if ($product->attachment == 1)
                                <td>
                                    <span class="badge bg-primary">Attachment Exist</span>
                                </td>
                            @else
                                <td>
                                    <span class="badge bg-danger">No Attachment</span>
                                </td>
                            @endif
                        </tr>
                        <div class="modal fade" id="discountModal{{ $product->id }}" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="discountModalLabel">Product Discount</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <p>Discount: IDR {{ number_format($product->discount) }}</p>
                                @if ($product->discount > 1000000)
                                    <span class="badge bg-warning">Approval Needed</span>
                                @endif
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@stop