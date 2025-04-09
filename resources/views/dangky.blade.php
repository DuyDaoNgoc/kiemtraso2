<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
        }
        .form-container h2 {
            color: #333;
            font-weight: bold;
        }
        .btn-primary {
            background: #667eea;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>

    <form action="{{ route('postsignin') }}" method="post" class="form-container">
        @csrf
        <h2 class="text-center mb-4">Đăng Ký Tài Khoản</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <div class="mb-3">
            <label for="fullname" class="form-label">Họ và tên</label>
            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Nhập họ và tên" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
        </div>

        <div class="mb-3">
            <label for="repassword" class="form-label">Nhập lại mật khẩu</label>
            <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Nhập lại mật khẩu" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ">
        </div>

        <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
    </form>

</body>
</html>
