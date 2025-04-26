console.log("News list");

document.querySelectorAll(".category-filter").forEach(button => {
    button.addEventListener("click", function () {
        const action = this.getAttribute("data-action");
        const dropdownButton = document.getElementById("categoryDropdown");
        const searchValue = document.getElementById("searchBook").value.toLowerCase();
        const rows = document.querySelectorAll("tbody tr");

        // ✅ Cập nhật nội dung hiển thị trên dropdown
        dropdownButton.innerText = this.innerText;

        // Lọc tin tức theo tiêu đề và trạng thái
        rows.forEach(row => {
            const title = row.querySelector("td:nth-child(2)").innerText.toLowerCase();
            const statusBadge = row.querySelector("td:nth-child(4) span");
            const matchesSearch = title.includes(searchValue);

            const matchesFilter =
                (action === "hide" && statusBadge.classList.contains("bg-secondary")) ||
                (action === "show" && statusBadge.classList.contains("bg-success")) ||
                (action === "pending" && statusBadge.classList.contains("bg-warning")) ||
                (action === "none");

            if (matchesSearch && matchesFilter) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});

// Tìm kiếm theo tiêu đề
document.getElementById("searchBook").addEventListener("input", function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        const title = row.querySelector("td:nth-child(2)").innerText.toLowerCase();
        if (title.includes(searchValue)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
