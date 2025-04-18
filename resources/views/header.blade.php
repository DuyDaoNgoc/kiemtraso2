@section('header')
<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if(Auth::check())
    <li><a href="#"><i class="fa fa-user"></i> Chào bạn {{ Auth::user()->full_name }}</a></li>
    <li><a href="{{ route('getlogout') }}"><i class="fa fa-user"></i> Đăng xuất</a></li>
@else
    <li><a href="{{ route('getsignin') }}">Đăng ký</a></li>
    <a href="{{ route('login') }}">Đăng nhập</a>

@endif

                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="index.html" id="logo"><img src="assets/dest/images/logo-cake.png" width="200px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="/">
                        <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">
                    <div class="cart">
                        <div class="beta-select"><a onclick="window.location.href='{{ route('cart') }}'" ><i class="fa fa-shopping-cart"></a></i> 
                                    Giỏ hàng 
                                    (
                                    @if(Session::has('cart'))
                                    {{ Session::get('cart')->totalQty }}
                                    @else
                                     Trống 
                                    @endif
                                    ) 
                                    <i class="fa fa-chevron-down"></i></div> <i class="fa fa-chevron-down"></i></div>
                       @if(Session::has('cart'))
                                    <div class="beta-dropdown cart-body">
                            @php $data = Session::get('cart');
                            @endphp
                            
                            @foreach($data->items as $key => $value)
                           
                            <div class="cart-item">
                                <div class="media">
                                    <a class="pull-left" ><img src="{{ asset('assets/dest/images/products/'.$value['product']['image']) }}" alt=""></a>
                                    <div class="media-body">
                                        <span class="cart-item-title">{{ $value['product']['name'] }}</span>
                                        <span class="cart-item-options">{{ $value['product']['unit'] }}</span>
                                        <span class="cart-item-amount">{{ $value['qty'] }}*<span>${{ $value['product']['unit_price'] }}</span></span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <div class="cart-caption">
                                <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">${{ $data->totalPrice }}</span></div>
                                <div class="clearfix"></div>

                                <div class="center">
                                    <div class="space10">&nbsp;</div>
                                    <a href="{{ route('checkout') }}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div> <!-- .cart -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{ route('trangchu') }}">Trang chủ</a></li>
                    <li><a href="{{ route('products.index') }}">Sản phẩm</a> <!-- Change to products.index -->
                        <ul class="sub-menu">
                            <li><a href="product_type.html">Sản phẩm 1</a></li>
                            <li><a href="product_type.html">Sản phẩm 2</a></li>
                            <li><a href="product_type.html">Sản phẩm 4</a></li>
                        </ul>
                    </li>
                    <li><a href="about.html">Giới thiệu</a></li>
                    <li><a href="contacts.html">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->
@endsection
