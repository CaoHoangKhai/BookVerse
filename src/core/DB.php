<?php
include __DIR__ . "/../../config.php";  // Đảm bảo đường dẫn đúng với cấu trúc thư mục của bạn

class DB
{
    public $conn;
    protected $servername = host_name;
    protected $username = db_user;
    protected $password = db_password;
    protected $dbname = db_name;


    // Constructor: Kết nối đến cơ sở dữ liệu
    function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

        // Kiểm tra kết nối
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Thiết lập charset để tránh lỗi ký tự đặc biệt
        mysqli_set_charset($this->conn, 'utf8');
    }

    // Hàm phân trang
    public function pagination($query, $limit, $start_from)
    {
        // Cải tiến: Kiểm tra câu lệnh SQL trước khi thực thi
        $sql = "$query LIMIT $start_from, $limit";
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }

        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    // Hàm sao lưu cơ sở dữ liệu
    public function backupDatabase()
    {
        // Lấy ngày hiện tại theo định dạng YYYY-MM-DD
        $date = date("d_m_Y");

        // Định dạng tên file backup có chứa ngày
        $backupFilePath = "C:\\xampp\\htdocs\\BookVerse\\database\\BookStore_backup_{$date}.sql";

        // Lệnh mysqldump
        $command = "C:\\xampp\\mysql\\bin\\mysqldump --host={$this->servername} --user={$this->username} --password={$this->password} {$this->dbname} > \"{$backupFilePath}\"";

        // Thực thi lệnh và ghi lại log
        $output = shell_exec($command . " 2>&1");

        // Kiểm tra nếu backup thành công hay không
        if (file_exists($backupFilePath)) {
            return "Backup thành công: " . $backupFilePath;
        } else {
            return "Backup thất bại! Lỗi: " . $output;
        }
    }


}
// Sử dụng class để sao lưu
$db = new DB();

$db->backupDatabase();
?>