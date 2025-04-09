<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide; // Import Model Slide

class HomeController extends Controller
{
    public function index()
    {
        $slide = Slide::all(); // Lấy tất cả dữ liệu từ bảng slides
        return view('slider', compact('slide')); // Truyền dữ liệu vào view
    }
}