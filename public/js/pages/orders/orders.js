console.log("Đã tải file order");
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchBook');
    const categoryDropdown = document.querySelectorAll('.category-filter');
    const rows = document.querySelectorAll('.order-row');

    // Hàm lọc đơn hàng
    function filterOrders() {
        const searchText = searchInput.value.toLowerCase();
        const selectedCategory = document.querySelector('#categoryDropdown').innerText.toLowerCase();

        rows.forEach(row => {
            const orderName = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            const orderStatus = row.getAttribute('data-status').toLowerCase();

            // Kiểm tra tìm kiếm theo tên và trạng thái
            const matchesSearch = orderName.includes(searchText);
            const matchesCategory = selectedCategory === 'tất cả' || orderStatus.includes(selectedCategory);

            // Hiển thị dòng nếu thỏa mãn điều kiện
            if (matchesSearch && matchesCategory) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Lắng nghe sự kiện tìm kiếm khi gõ
    searchInput.addEventListener('input', filterOrders);

    // Lắng nghe sự kiện chọn trạng thái từ dropdown
    categoryDropdown.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            document.querySelector('#categoryDropdown').innerText = category;
            filterOrders();
        });
    });
});

