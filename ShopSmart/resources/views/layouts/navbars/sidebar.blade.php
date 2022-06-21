<div class="sidebar" data-color="azure" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __(Auth::user()->email) }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      @if(Auth::user()->role=="admin")
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Categories') }}</p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/allProducts">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Products') }}</p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/adminVendors">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Vendors') }}</p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/adminOrders">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Orders') }}</p>
        </a>
      </li>
      @endif
      @if(Auth::user()->role=="vendor")
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
        @if(Auth::user()->status=="accepted")
        <li class="nav-item">
          <a class="nav-link" href="/vendorform">
            <i class="material-icons">dashboard</i>
              <p>{{ __('Add Product Request') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/viewProducts">
            <i class="material-icons">dashboard</i>
              <p>{{ __('All Requests') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/addProduct">
            <i class="material-icons">dashboard</i>
              <p>{{ __('Add Product') }}</p>
          </a>
        </li>
        @endif
      @endif
      @if(Auth::user()->role=="user")
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      @endif

      <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.edit') }}">
          <i class="material-icons">dashboard</i>
          <span class="sidebar-normal">{{ __('Your profile') }} </span>
        </a>
      </li>
    </ul>
  </div>
</div>
