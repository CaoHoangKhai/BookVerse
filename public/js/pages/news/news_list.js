console.log("News list");

// Lắng nghe sự kiện khi chọn bộ lọc
document.querySelectorAll(".category-filter").forEach(button => {
    button.addEventListener("click", function () {
        let action = this.getAttribute("data-action");
        let filterContainer = document.getElementById("filterContainer");
        let searchValue = document.getElementById("searchBook").value.toLowerCase(); // Lấy giá trị tìm kiếm
        let rows = document.querySelectorAll("tbody tr"); // Lấy tất cả các dòng trong bảng tin tức

        if (action === "hide") {
            filterContainer.style.display = "none"; // Ẩn bộ lọc
        } else if (action === "show") {
            filterContainer.style.display = "flex"; // Hiện bộ lọc
        }

        // Lọc bảng tin tức dựa vào trạng thái và tìm kiếm tiêu đề
        rows.forEach(row => {
            let title = row.querySelector("td:nth-child(2)").innerText.toLowerCase(); // Lấy tiêu đề
            let statusBadge = row.querySelector("td:nth-child(4) span"); // Cột trạng thái
            let matchesSearch = title.includes(searchValue); // Kiểm tra tiêu đề có chứa từ khóa không
            let matchesFilter = 
                (action === "hide" && statusBadge.classList.contains("bg-secondary")) || // Ẩn: Chỉ hiện bài bị ẩn
                (action === "show" && statusBadge.classList.contains("bg-success")) || // Hiển thị: Chỉ hiện bài hiển thị
                (action === "none"); // Tất cả

            if (matchesSearch && matchesFilter) {
                row.style.display = ""; // Hiện dòng phù hợp
            } else {
                row.style.display = "none"; // Ẩn dòng không phù hợp
            }
        });
    });
});

// Tìm kiếm theo tiêu đề
document.getElementById("searchBook").addEventListener("input", function () {
    let searchValue = this.value.toLowerCase();
    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        let title = row.querySelector("td:nth-child(2)").innerText.toLowerCase();
        if (title.includes(searchValue)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
