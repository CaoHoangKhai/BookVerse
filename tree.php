<?php
function listFolderTree($dir, $level = 0) {
    // Kiểm tra nếu thư mục tồn tại
    if (!is_dir($dir)) {
        echo "<p>Thư mục không tồn tại.</p>";
        return;
    }
    
    // Mở thư mục
    $files = scandir($dir);
    echo "<ul>";
    
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && $file !== '.git') {
            $filePath = $dir . DIRECTORY_SEPARATOR . $file;
            
            // In ra tên file hoặc folder
            echo "<li>" . htmlspecialchars($file);
            
            // Nếu là thư mục, gọi đệ quy
            if (is_dir($filePath)) {
                listFolderTree($filePath, $level + 1);
            }
            echo "</li>";
        }
    }
    
    echo "</ul>";
}

// Gọi hàm hiển thị cây thư mục
$rootDir = __DIR__; // Thay đổi thành thư mục bạn muốn liệt kê
listFolderTree($rootDir);
?>
