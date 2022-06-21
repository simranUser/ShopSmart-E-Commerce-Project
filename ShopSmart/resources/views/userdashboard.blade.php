@extends('layout')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <!--<i class="material-icons" id="carticon">shopingcart</i>-->
      <div class="alert alert-success" style='display:none' id='cartmsg'></div>

      <div class="row">
        @foreach($products as $product)
            <div class="col-xs-18 col-sm-6 col-md-3">
                <div class="thumbnail"><br>
                <img src='{{ asset("storage/uploads/$product->image") }}'  width='100%' />  
                <div class="caption">
                        <h4>{{ $product->name }}</h4>
                        <p>{{ $product->description }}</p>
                        <p><strong>Price: </strong> Rs.{{ $product->price }}</p>
                        <p class="btn-holder"><button type="button" class="btn btn-warning btn-block text-center" onclick="addtocart({{$product->id}})" role="button">Add to cart</button> </p>
                    </div>
                </div>
            </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection

@push('js')

  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
 

@endpush