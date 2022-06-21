@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <form id="productForm">
          @csrf
        <!--<h4 class="heading center">Send Request to SuperAdmin</h4>--><br>
        <div class="alert alert-success" style="display:none" id="editsuccess"></div><br>

        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name" value="{{$data2[0]->name}}" required>
        </div><br>

        <div class="form-group">
          <label for="description">Description</label><br>
          <textarea id="description" name="description" rows="4" cols="50" class="" required>{{$data2[0]->description}}</textarea>
        </div><br>

        @if($data2[0]->status=='accepted')
        <div class="form-group">
          <label>You can't change price for accepted products ,make another request for the same</label>
          <input type="number" class="form-control" name="price" id="price" placeholder="Price (In figures)" disabled value="{{$data2[0]->price}}"required style="color:lightgrey">
        </div><br>
        @else
        <div class="form-group">
        <label>price</label>
          <input type="number" class="form-control" name="price" id="price" placeholder="Price (In figures)" value="{{$data2[0]->price}}"required>
        </div><br>
        @endif

        <div class="form-group form-file-upload form-file-multiple">
          <input type="file" multiple="" id="image" name="image" value="{{$data2[0]->image}}"class="inputFileHidden">
          <div class="input-group">
              <input type="text" class="form-control inputFileVisible"name="imageinput" value="{{$data2[0]->image}}" placeholder="{{$data2[0]->image}}">
              <span class="input-group-btn">
                  <button type="button" class="btn btn-fab btn-round btn-primary">
                      <i class="material-icons">attach_file</i>
                  </button>
              </span>
          </div>
        </div>

        <div class="form-group">
          <label>Category</label>
          <select id="catid" name="catid" class="form-control balck" required>
            <option value="{{$data2[0]->category->uuid}}" selected class="black">{{$data2[0]->category->name}}</option>
            @foreach($data as $d)
            <option value="{{$d->uuid}}">{{$d->name}}</option>
            @endforeach
          </select>
        </div><br>

        <input type="hidden" value="update" name="action" id="action">
        <input type="hidden" value="{{$data2[0]->id}}" name="editid" id="editid">

        <button type="submit" class="btn btn-azure btnmargin" id="productUpdate">Update</button><br><br>
        <a href="/viewProducts" id="productslink">See all your products</a>

      </form>
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