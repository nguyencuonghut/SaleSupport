<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="fas fa-shopping-cart"></i>
      <span class="badge badge-success navbar-badge">{{Cart::count()}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-item dropdown-header">{{Cart::count()}} sản phẩm cho {{Cart::content()->count()}} mã hàng</span>
      @foreach (Cart::content() as $item)
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            {{$item->name}}
            <span class="float-right text-muted text-sm">{{$item->qty}} bao</span>
        </a>
      @endforeach
      <div class="dropdown-divider"></div>
      <a href="{{route('user.cart')}}" class="dropdown-item dropdown-footer">Xem giỏ hàng</a>
    </div>
  </li>
