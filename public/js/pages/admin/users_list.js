
document.getElementById("searchInput").addEventListener("keyup", function () {
    let searchValue = this.value.toLowerCase(); // Chuyển đổi thành chữ thường
    let rows = document.querySelectorAll("#list-user tr");

    rows.forEach(function (row) {
        let name = row.querySelector(".searchable").textContent.toLowerCase(); // Lấy nội dung cột tên
        if (name.includes(searchValue)) {
            row.style.display = ""; // Hiển thị nếu có từ khóa
        } else {
            row.style.display = "none"; // Ẩn nếu không phù hợp
        }
    });
});

