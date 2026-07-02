# SUNFLAMECARE

## Chạy dự án

### 1. Chuẩn bị môi trường
- Cài XAMPP hoặc bộ PHP + MySQL tương đương.
- Bật `Apache` và `MySQL`.
- Đảm bảo MySQL chạy ở cổng `3306`.

### 2. Import database
- Tạo database tên `users_db`.
- Import file [`schema.sql`](schema.sql) vào database đó.

### 3. Kiểm tra cấu hình
Mở [`config.php`](config.php) và kiểm tra các giá trị sau:
- host: `localhost`
- database: `users_db`
- username: `root`
- password: rỗng
- port: `3306`

### 4. Chạy website
Nếu project nằm trong `htdocs` của XAMPP:
- `http://localhost/SUNFLAMECARE/index.php`

Hoặc chạy PHP built-in server từ thư mục dự án:
```bash
C:\xampp\php\php.exe -S localhost:8000
```
Sau đó mở:
- `http://localhost:8000/index.php`

## Cài thư viện PHP
Nếu cần cài lại thư viện Composer, dùng:
```bash
C:\xampp\php\php.exe C:\composer\composer.phar install
```

## Ghi chú
- Project đang dùng `users_db`.
- Một số file còn kết nối MySQL trực tiếp bằng `mysqli`, nhưng đều đã được đồng bộ sang cổng `3306`.
