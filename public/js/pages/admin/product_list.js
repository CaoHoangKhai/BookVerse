document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchBook");
    const categoryDropdown = document.getElementById("categoryDropdown");
    const categoryButtons = document.querySelectorAll(".category-filter");
    const bookTable = document.getElementById("bookTable").getElementsByTagName("tr");

    let selectedCategory = "Tất cả"; // Mặc định là tất cả

    // Lọc sách khi nhập vào ô tìm kiếm
    searchInput.addEventListener("keyup", function () {
        filterBooks();
    });

    // Lọc sách khi chọn thể loại
    categoryButtons.forEach(button => {
        button.addEventListener("click", function () {
            selectedCategory = this.getAttribute("data-category");
            categoryDropdown.innerText = selectedCategory; // Cập nhật nút dropdown
            filterBooks();
        });
    });

    function filterBooks() {
        const searchValue = searchInput.value.toLowerCase();

        for (let i = 0; i < bookTable.length; i++) {
            let bookTitle = bookTable[i].getElementsByTagName("td")[1].textContent.toLowerCase(); // Cột tiêu đề sách
            let bookCategory = bookTable[i].getElementsByTagName("td")[4].textContent.trim(); // Cột thể loại

            let titleMatch = bookTitle.includes(searchValue);
            let categoryMatch = selectedCategory === "Tất cả" || bookCategory === selectedCategory;

            // Hiển thị nếu khớp cả hai điều kiện
            bookTable[i].style.display = (titleMatch && categoryMatch) ? "" : "none";
        }
    }
});