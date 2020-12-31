@extends('layouts.app')

@section('content')
<div class="card-body">
    
    @if (session('Error'))
        <div class="alert alert-success" role="alert">
            {{ session('Error') }}
        </div>
    @endif

</div>
<div class="container">
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <a class="navbar-brand " href="#">Totol Product ({{$product->count()}} )</a>
        <a class="navbar-brand " href="{{route('product.create')}}"><i class="fas fa-cart-plus" style="color: white;"></i></a>
    </nav>
        <div class="table-responsive">
            <table class="table table-striped table-dark text-white table-hover">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Image</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $product as $products)
                    
                        <tr>
                            <td>
                                <h6>{{$products->product_name}}</h6>
                            </td>
                            <td>{{$products->product_price}}<br></td>
                            <td>
                                <div class="d-flex align-items-center"><img class="rounded-circle" src="{{$products->product_image}}" alt="Img Not Found" width="50" height="50"><span class="ml-2"></span></div>
                            </td>
                            <td class="font-weight-bold"> <a class="navbar-brand" href="{{route('product.edit',['id'=>$products->id])}}"><i class="far fa-edit" style="color: white;"></i></a>
                             <a class="navbar-brand" href="{{route('product.delete',['id'=>$products->id])}}"><i class="fal fa-trash-alt" style="color: white;"></i></a></td>
                            <td></td>
                            <td><i class="fa fa-external-link external-link"></i></td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>

</div>


@endsection