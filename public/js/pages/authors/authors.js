console.log("Đã tải file author");
document.getElementById('searchInput').addEventListener('keyup', function() {
    // Lấy giá trị tìm kiếm từ ô input
    let searchQuery = this.value.toLowerCase();
    
    // Lấy tất cả các hàng trong bảng
    let rows = document.querySelectorAll('#bookTable tr');
    
    // Lặp qua từng hàng và kiểm tra tên tác giả
    rows.forEach(row => {
        let authorName = row.cells[2].textContent.toLowerCase();  // Lấy tên tác giả (cột thứ 3)
        
        // Kiểm tra nếu tên tác giả chứa từ khóa tìm kiếm
        if (authorName.indexOf(searchQuery) !== -1) {
            row.style.display = '';  // Hiển thị hàng nếu khớp
        } else {
            row.style.display = 'none';  // Ẩn hàng nếu không khớp
        }
    });
});