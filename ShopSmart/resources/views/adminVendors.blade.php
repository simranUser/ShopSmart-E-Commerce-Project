@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div id="adminmsg" class="alert alert-success" style="display:none"></div>
      <table class="table">
            <thead>
                <tr class="text-center">
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr class="text-center" id="{{$d->id}}">
                    <td class="text-center">1</td>
                    <td>{{$d->name}}</td>
                    <td>{{$d->email}}</td>
                    <th id="vstatus{{$d->id}}">{{$d->status}}</th>
                    <td class="td-actions">
                        @if($d->status=="rejected")
                        <button type="button" rel="tooltip" class="btn btn-success" id="acceptvendorbtn" onclick="acceptVendor({{$d->id}})">
                          Accept
                        </button>
                        @elseif($d->status=="accepted")
                        <button type="button" rel="tooltip" class="btn btn-danger" id="rejectvendorbtn" onclick="rejectVendor({{$d->id}})">
                            Reject
                        </button>
                        @else
                        <button type="button" rel="tooltip" class="btn btn-success" id="acceptvendorbtn" onclick="acceptVendor({{$d->id}})">
                          Accept
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger" id="rejectvendorbtn" onclick="rejectVendor({{$d->id}})">
                            Reject
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
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