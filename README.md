# ClassroomInventory
1. Tải XAMPP (lưu ý nếu có MySQL thì dễ conflict do chung port 3306 :)) nếu k fix được thì xóa MySQL đi tạm nhé)
   Sau khi tải bật XAMPP Control Panel lên và Khởi động Apache và MySQL
3. Tải file về và làm theo hướng dẫn như sau:
  - Tìm folder xampp ```xampp/htdocs```. Tạo 1 folder mới tên ```class```, dán tất cả các file vào 1 folder đó. 
  - Mở PHPMyAdmin (http://localhost/phpmyadmin)
  - Tạo một database mới tên ```class```
  - Import file sql ```class_inventory.sql``` 
  - Truy câp http://localhost/class để xem kết quả
4. Tự thêm dữ liệu vào các bảng để test tính năng
5. Khi chạy file SQL, tắt nút "Enable Foreign Key Check"
