@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 80px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shop</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>Products In Our Store</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-3">
                            <div class="card" style="margin-bottom: 20px; height: auto;">
                                <img src="{{$product->product_image}}"
                                     class="card-img-top mx-auto"
                                     style="height: 150px; width: 150px;display: block;"
                                     alt=""
                                >
                                <div class="card-body">
                                    <nav class="navbar">
                                        <h6 class="navbar-brand">{{$product->product_name}}</h6>
                                        <h6 class="navbar-brand">${{$product->product_price}}</h6>
                                    </nav>
                                  
                                    <a class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart" href="{{route('home',['id'=>$product->id])}}">
                                        <i class="fa fa-shopping-cart"></i> Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection