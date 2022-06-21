@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="alert alert-success" style="display:none" id="adminmsg"></div><br>

        <form id="vendorfilterform">
            <!--<input type="text" name="vendorfilter" id="vendorfilter" placeholder="Search for any vendor">-->
            <select name="vendorfilter" id="vendorfilter">
              <option value="" selected disabled>See particular vendor</option>
              @foreach($data2 as $d2)
              <option value="{{$d2->name}}">{{$d2->name}}</option>
              @endforeach
            </select>
        </form>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Vendor</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="allproduct" class="text-center">
                @foreach($data as $d)
                <tr id="{{$d->id}}">
                    <td class="text-center">1</td>
                    <td>{{$d->name}}</td>
                    <td>{{$d->description}}</td>
                    <td id="price{{$d->id}}">{{$d->price}}</td>
                    <td>{{$d->vendor}}</td>
                    <th id="status{{$d->id}}">{{$d->status}}</th>
                    <td class="td-actions">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modal" onclick="editproduct({{$d->id}})">
                            <i class="material-icons">edit</i>
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger" onclick="reject({{$d->id}})">
                            <i class="material-icons">close</i>
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-success"id="acceptbtn" onclick="accept({{$d->id}})">
                            Accept
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data2->links() }}
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
            <form id="changeproductform">
              <!--<h4 class="heading center">Send Request to SuperAdmin</h4>--><br>

              <div class="form-group">
                <label for="price">Price</label><br>
                <input type="number" class="form-control" name="price" id="price" placeholder="Price (In figures)" required>
              </div><br>

              <input type="hidden" name="editid" id="editid">        
              <button type="submit" class="btn btn-azure btnmargin" id="updateproduct">Update</button><br><br>
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