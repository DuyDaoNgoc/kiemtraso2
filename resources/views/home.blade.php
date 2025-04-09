@extends('index')

@include('header')
@include('footer')
@include('slider')

@section('content')
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>

            <!-- New Products -->
            <div class="beta-products-list">
                <h4>Sản phẩm mới</h4>
                <div class="beta-products-details">
                    <p class="pull-left">{{ isset($products) ? count($products) : 0 }} sản phẩm được tìm thấy</p>
                    <div class="clearfix"></div>
                </div>

                <div class="row">
                    @if(isset($products) && count($products) > 0)
                        @foreach($products as $key => $new_product)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($new_product->promotion_price != 0)
                                        <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a >
                                            <img src="{{ asset('assets/dest/images/products/'.$new_product->image) }}" alt="{{ $new_product->name }}" height="250px">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $new_product->name }}</p>
                                        <p class="single-item-price">
                                            @if($new_product->promotion_price == 0)
                                                <span class="flash-sale">{{ number_format($new_product->unit_price) }} đồng</span>
                                            @else
                                                <span class="flash-del">{{ number_format($new_product->unit_price) }} đồng</span>
                                                <span class="flash-sale">{{ number_format($new_product->promotion_price) }} đồng</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{ route('add_cart', ['id' =>$new_product->id]) }}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" >Chi tiết <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @if(($key + 1) % 4 == 0)
                                <div class="space40">&nbsp;</div>
                            @endif
                        @endforeach
                    @else
                        <p class="text-center">Không có sản phẩm nào.</p>
                    @endif
                </div>
            </div>

            <div class="space50">&nbsp;</div>

            <!-- Promotion Products -->
            <div class="beta-products-list">
                <h4>Sản phẩm khuyến mãi</h4>
                <div class="beta-products-details">
                    <p class="pull-left">{{ isset($number_promotion) ? $number_promotion : 0 }} sản phẩm khuyến mãi</p>
                    <div class="clearfix"></div>
                </div>

                <div class="row">
                    @if(isset($promotion) && count($promotion) > 0)
                        @foreach($promotion as $key => $value)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    <div class="single-item-header">
                                        <a>
                                            <img src="{{ asset('assets/dest/images/products/'.$value->image) }}" alt="{{ $value->name }}">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $value->name }}</p>
                                        <p class="single-item-price">
                                            <span class="flash-del">{{ number_format($value->unit_price) }} đồng</span>
                                            <span class="flash-sale">{{ number_format($value->promotion_price) }} đồng</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{ route('add_cart', ['id' =>$value->id]) }}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" >Chi tiết <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $promotion->links('pagination::bootstrap-4') }}
                    @else
                        <p class="text-center">Không có sản phẩm khuyến mãi.</p>
                    @endif
                </div>
            </div>

            <div class="space50">&nbsp;</div>

            <!-- Top Products -->
            <div class="beta-products-list">
                <h4>Sản phẩm bán chạy</h4>
                <div class="beta-products-details">
                    <p class="pull-left">{{ isset($number_top) ? $number_top : 0 }} sản phẩm bán chạy</p>
                    <div class="clearfix"></div>
                </div>

                <div class="row">
                    @if(isset($product_top) && count($product_top) > 0)
                        @foreach($product_top as $key => $new_product)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($new_product->promotion_price != 0)
                                        <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a >
                                            <img src="{{ asset('assets/dest/images/products/'.$new_product->image) }}" alt="{{ $new_product->name }}" height="250px">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $new_product->name }}</p>
                                        <p class="single-item-price">
                                            @if($new_product->promotion_price == 0)
                                                <span class="flash-sale">{{ number_format($new_product->unit_price) }} đồng</span>
                                            @else
                                                <span class="flash-del">{{ number_format($new_product->unit_price) }} đồng</span>
                                                <span class="flash-sale">{{ number_format($new_product->promotion_price) }} đồng</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left"  href="{{ route('add_cart', ['id' =>$new_product->id]) }}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary"  >Chi tiết <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @if(($key + 1) % 4 == 0)
                                <div class="space40">&nbsp;</div>
                            @endif
                        @endforeach
                    @else
                        <p class="text-center">Không có sản phẩm bán chạy.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
