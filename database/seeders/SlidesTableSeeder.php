<?php
use Illuminate\Database\Seeder;
use App\Models\Slide;

class SlideSeeder extends Seeder
{
    public function run()
    {
        Slide::create([
            'image' => 'slide1.jpg',
            'title' => 'Khuyến mãi đặc biệt',
            'description' => 'Giảm giá cực sốc chỉ hôm nay!'
        ]);

        Slide::create([
            'image' => 'slide2.jpg',
            'title' => 'Sản phẩm mới',
            'description' => 'Cập nhật các sản phẩm hot nhất thị trường.'
        ]);
    }
}
