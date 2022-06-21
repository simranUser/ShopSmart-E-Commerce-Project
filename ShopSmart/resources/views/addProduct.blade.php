@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="alert alert-success" style="display:none" id="deletesuccess"></div><br>

        <table class="table">
            <thead>
                <tr class="text-center">
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr class="text-center" id="{{$d->id}}">
                    <td class="text-center">1</td>
                    <td>{{$d->name}}</td>
                    <td>{{$d->description}}</td>
                    <td>{{$d->price}}</td>
                    <th>{{$d->status}}</th>
                    <td class="td-actions">
                        <button type="button" rel="tooltip" class="btn btn-success" onclick="uploadproduct({{$d->id}})">
                            Upload
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger" onclick="removeproduct({{$d->id}})">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
  </div>

    <!-- modal to add category-->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
					<h2 class="modal-title" id="exampleModalLabel"> Add Category</h2>
			  </div>
			  <div class="modal-body"><hr style="margin-top:-20px;">
          <form id="productForm">
            <!--<h4 class="heading center">Send Request to SuperAdmin</h4>--><br>
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

            <div class="form-group">
              <select id="catid" name="catid" class="form-control" required>
                <option value="" disabled selected>Click to Assign Category</option>
                  @foreach($data as $d)
                    <option value="{{$d->uuid}}">{{$d->name}}</option>
                  @endforeach
              </select>
            </div><br>

            <input type="hidden" class="form-control" name="vendor" id="vendor" value="{{Auth::user()->email}}">        
            <button type="submit" class="btn btn-azure btnmargin" id="productSubmit">Submit</button><br><br>
            <a href="/viewProducts" id="productslink">See all your products</a>
          </form>
			  </div>
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