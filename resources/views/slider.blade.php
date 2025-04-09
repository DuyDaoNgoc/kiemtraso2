@section('slider')
<div class="rev-slider">
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <div class="bannercontainer">
                <div class="banner">
                    @if(isset($slide) && $slide->count() > 0)
                        <ul>
                            @foreach($slide as $value)
                                <li data-transition="boxfade" data-slotamount="20" class="active-revslide" 
                                    style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                    <div class="slotholder" style="width:100%;height:100%;">
                                        <div class="tp-bgimg defaultimg"
                                             style="background-color: rgba(0, 0, 0, 0);
                                                    background-repeat: no-repeat;
                                                    background-image: url('{{ asset('assets/dest/images/thumbs/'.$value->image) }}');
                                                    background-size: cover;
                                                    background-position: center center;
                                                    width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center">Không có slide nào để hiển thị.</p>
                    @endif
                </div>
            </div>
            <div class="tp-bannertimer"></div>
        </div>
    </div>
</div>
@endsection
