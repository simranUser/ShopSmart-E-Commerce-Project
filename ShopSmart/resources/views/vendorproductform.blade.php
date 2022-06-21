@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <form id="productForm" enctype="multipart/form-data">
        <!--<h4 class="heading center">Send Request to SuperAdmin</h4>--><br>
        <div class="alert alert-success" style="display:none" id="insertsuccess"></div><br>

        <div class="form-group">
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name" required>
        </div><br>

        <div class="form-group">
          <label for="description">Description</label><br>
          <textarea id="description" name="description" rows="4" cols="50" class="" required></textarea>
        </div><br>

        <div class="form-group">
          <input type="number" class="form-control" name="price" id="price" placeholder="Price (In figures)" required>
        </div><br>

        <div class="form-group form-file-upload form-file-multiple">
          <input type="file" multiple="" id="image" name="image" class="inputFileHidden">
          <div class="input-group">
              <input type="text" class="form-control inputFileVisible" placeholder="Choose image for your product">
              <span class="input-group-btn">
                  <button type="button" class="btn btn-fab btn-round btn-primary">
                      <i class="material-icons">attach_file</i>
                  </button>
              </span>
          </div>
        </div>

        <div class="form-group">
          <select id="catid" name="catid" class="form-control catid" required>
            <option value="" disabled selected>Click to Assign Category</option>
            @foreach($data as $d)
            <option value="{{$d->uuid}}">{{$d->name}}</option>
            @endforeach
          </select>
        </div><br>
        


        <input type="hidden" value="insert" name="action" id="action">
        <input type="hidden" class="form-control" name="vendor" id="vendor" value="{{Auth::user()->email}}">        
        <button type="submit" class="btn btn-azure btnmargin" id="productSubmit">Submit</button><br><br>
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