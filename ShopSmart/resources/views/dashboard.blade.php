@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div id="adminmsg" class="alert alert-success" style="display:none"></div>
      <div id="addbtndiv">
        <button type="button" class="btn btn-primary pull" id="addcategorybtn" data-toggle="modal" data-target="#Modal">Add Category</button> <span id="addtext"> <span>
      </div>

      <table class="table">
            <thead>
                <tr class="text-center">
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="categorybody">
                @foreach($data as $d)
                <tr class="text-center" id="cat{{$d->id}}">
                    <td class="text-center">1</td>
                    <td id="catname{{$d->id}}">{{$d->name}}</td>
                    <td class="td-actions">
                        <button type="button" rel="tooltip" class="btn btn-success" data-toggle="modal" data-target="#Modal" onclick="editCategory({{$d->id}})">
                          <i class="material-icons">edit</i>
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger" onclick="removeCategory({{$d->id}})">
                          <i class="material-icons">close</i>
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
			  <div class="modal-body">
					<form id="categoryform">
            @csrf
						<div class="form1">
              <div><br><br>
                <input type="text" class="categoryname form-control" name="categoryname" id="categoryname" required placeholder="Type Category Name"><br><br>
              </div><br>

              <input type="hidden" name="action" id="action" value="insert">
              <input type="hidden" name="editid" id="editid">

              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
							<button type="submit" name ="categorysubmit" id="categorysubmit" class="btn btn-primary" data-dismiss="">Submit</button>
						</div>
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