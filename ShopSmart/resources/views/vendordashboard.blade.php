@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      @if(Auth::user()->status=="accepted")
        <h3 id="vendorheading">Your Request as vendor is accepted by admin,you can send product request to admin now</h3>
      @elseif(Auth::user()->status=="rejected")
        <h3 id="vendorheading">Your Request as vendor is rejected by SuperAdmin ,So your Vendor Modules are Locked</h3>
      @else
        <h3 id="vendorheading">Your Request as vendor is not accepted by SuperAdmin ,So your Vendor Modules are still Locked</h3>
      @endif
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