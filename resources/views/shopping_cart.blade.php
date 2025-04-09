@extends('index')
@include('header')
@include('footer')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Shopping Cart</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a>Home</a> / <span>Shopping Cart</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">    
        <div class="table-responsive">
            <!-- Shop Products Table -->
            <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-status">Unit</th>
                        <th class="product-quantity">Qty.</th>
                        <th class="product-subtotal">Total</th>
                        <th class="product-remove">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @php $productCarts = Session::get('cart'); @endphp
                    @foreach($productCarts->items as $key => $value)
                    <tr class="cart_item">
                        <td class="product-name">
                            <div class="media">
                                <img class="pull-left" src="{{ asset('assets/dest/images/products/'.$value['product']['image']) }}" width="50px" height="50px" alt="">
                                <div class="media-body">
                                    <p class="font-large table-title">{{ $value['product']['name'] }}</p>
                                    <a class="table-edit" href="#">Edit</a>
                                </div>
                            </div>
                        </td>

                        <td class="product-price">
                            <span class="amount">${{$value['product']['unit_price'] }}</span>
                        </td>

                        <td class="product-status">
                            {{ $value['product']['unit'] }}
                        </td>

                        <td class="product-quantity d-flex">
                           
                            <label>{{ $value['qty'] }}</label>
                            
                        </td>

                        <td class="product-subtotal">
                            <span class="amount">${{$value['price'] }}</span>
                        </td>

                        <td class="product-remove">
                            <form action="{{ route('cart.destroy', ['id' => $value['product']['id']]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="remove" title="Remove this item"><i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="6" class="actions">
                            <form  method="POST" class="coupon-form">
                                @csrf
                                <div class="coupon">
                                    <label for="coupon_code">Coupon</label> 
                                    <input type="text" name="coupon_code" value="" placeholder="Coupon code"> 
                                    <button type="submit" class="beta-btn primary">Apply Coupon <i class="fa fa-chevron-right"></i></button>
                                </div>
                            </form>
                            
                            <button type="submit" class="beta-btn primary" name="update_cart">Update Cart <i class="fa fa-chevron-right"></i></button> 
                            <a href="{{ route('checkout') }}" class="beta-btn primary">Proceed to Checkout <i class="fa fa-chevron-right"></i></a>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <!-- End of Shop Table Products -->
        </div>

        <!-- Cart Collaterals -->
        <div class="cart-collaterals">
            <div class="cart-totals pull-right">
                <div class="cart-totals-row"><h5 class="cart-total-title">Cart Totals</h5></div>
                <div class="cart-totals-row"><span>Cart Subtotal:</span> <span>${{ number_format($productCarts->totalPrice, 2) }}</span></div>
                <div class="cart-totals-row"><span>Shipping:</span> <span>Free Shipping</span></div>
                <div class="cart-totals-row"><span>Order Total:</span> <span>${{ number_format($productCarts->totalPrice, 2) }}</span></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- End of Cart Collaterals -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
