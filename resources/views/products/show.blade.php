<!-- resources/views/products/show.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <div class="row">
            <!-- Hiển thị ảnh sản phẩm -->
            <div class="col-md-6 text-center">
                @if($product->image)
                    <img src="{{ asset('assets/dest/images/products/'.$product->image) }}" 
                         alt="{{ $product->name }}" class="img-fluid rounded">
                @else
                    <img src="https://via.placeholder.com/400" class="img-fluid rounded" alt="No image available">
                @endif
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <h1 class="mb-3">{{ $product->name }}</h1>
                <p><strong>Loại sản phẩm:</strong> {{ $product->type_name }}</p>
                <p><strong>Mô tả:</strong> {{ $product->type_description }}</p>
                <p class="text-danger fw-bold fs-4">
                    Giá: {{ number_format($product->unit_price, 0, ',', '.') }} VNĐ
                </p>
                <p><strong>Chi tiết sản phẩm:</strong> {{ $product->description }}</p>

                <!-- Form thêm vào giỏ hàng -->
                <form action="{{ url('/cart/add/'.$product->id) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng:</label>
                        <input type="number" name="quantity" class="form-control w-50" min="1" value="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
