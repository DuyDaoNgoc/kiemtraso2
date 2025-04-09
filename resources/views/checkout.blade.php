@extends('index')

@section('content')
    <div class="container">
        <div id="content">
            <form action="{{ route('order') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Đặt hàng</h4>
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="name">Họ tên*</label>
                            <input type="text" id="name" placeholder="Họ tên" name="name" required>
                        </div>

                        <div class="form-block">
                            <label>Giới tính </label>
                            <input type="radio" name="gender" value="nam" checked> Nam
                            <input type="radio" name="gender" value="nữ"> Nữ
                        </div>

                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input type="email" id="email" required placeholder="example@gmail.com" name="email">
                        </div>

                        <div class="form-block">
                            <label for="address">Địa chỉ*</label>
                            <input type="text" id="address" placeholder="Street Address" name="address" required>
                        </div>

                        <div class="form-block">
                            <label for="phone">Điện thoại*</label>
                            <input type="text" id="phone" name="phone_number" required>
                        </div>

                        <div class="form-block">
                            <label for="notes">Ghi chú</label>
                            <textarea id="notes" name="notes"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                            <div class="your-order-body">
                                <div class="your-order-item">
                                    @php $productCarts = Session::get('cart'); @endphp
                                    @if($productCarts)
                                        @foreach($productCarts->items as $value)
                                            <div class="media">
                                                <img width="25%" src="{{ asset('assets/dest/images/products/'.$value['product']['image']) }}" alt="" class="pull-left">
                                                <div class="media-body">
                                                    <p class="font-large">{{ $value['product']['name'] }}</p>
                                                    <span class="cart-product-amount">{{ $value['qty'] }} x 
                                                        {{ number_format($value['product']['promotion_price'] == 0 ? $value['product']['unit_price'] : $value['product']['promotion_price']) }} đồng
                                                    </span>
                                                    <span class="color-gray your-order-info">Thành tiền: 
                                                        {{ number_format(($value['product']['promotion_price'] == 0 ? $value['product']['unit_price'] : $value['product']['promotion_price']) * $value['qty']) }} đồng
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>Giỏ hàng của bạn đang trống.</p>
                                    @endif
                                </div>
                                <div class="your-order-item">
                                    <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
                                    <div class="pull-right">
                                        <h5 class="color-black">
                                            {{-- {{ isset($totalPrice) ? number_format($totalPrice) : '0' }} đồng --}}
                                        </h5>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
                            <div class="your-order-body">
                                <ul class="payment_methods methods">
                                    <li>
                                        <input type="radio" name="payment_method" value="COD" checked> Thanh toán khi nhận hàng
                                    </li>
                                    <li>
                                        <input type="radio" name="payment_method" value="ATM"> Chuyển khoản
                                    </li>
                                    <li>
                                        <input type="radio" name="payment_method" value="VNPAY"> Thanh toán online
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="beta-btn primary">Đặt hàng <i class="fa fa-chevron-right"></i></button>
                            </div>
                        </div> 
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
