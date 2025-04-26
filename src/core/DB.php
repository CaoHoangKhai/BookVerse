<?php
include __DIR__ . "/../../config.php";

class DB
{
    public $conn;
    protected $servername = host_name;
    protected $username = db_user;
    protected $password = db_password;
    protected $dbname = db_name;

    private $mysqlDumpPath = "C:\\xampp\\mysql\\bin\\mysqldump.exe";

    public function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_set_charset($this->conn, 'utf8');
    }

    public function pagination($query, $limit, $start_from)
    {
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

    public function backupDatabase()
    {
        $date = date("d_m_Y"); // ❗ chỉ lấy ngày tháng năm

        $projectRoot = realpath(__DIR__ . '/../../');
        $backupDirectory = $projectRoot . DIRECTORY_SEPARATOR . 'database';

        if (!file_exists($backupDirectory)) {
            mkdir($backupDirectory, 0777, true);
        }

        $backupFilePath = $backupDirectory . DIRECTORY_SEPARATOR . "BookStore_backup_{$date}.sql";

        $command = "\"{$this->mysqlDumpPath}\" --host={$this->servername} --user={$this->username} --password=\"{$this->password}\" {$this->dbname} > \"{$backupFilePath}\"";

        $output = shell_exec($command . " 2>&1");

        // if (file_exists($backupFilePath)) {
        //     return "✅ Backup thành công: {$backupFilePath}";
        // } else {
        //     return "❌ Backup thất bại! Chi tiết lỗi: " . $output;
        // }
    }
}

// Sử dụng
$db = new DB();
echo $db->backupDatabase();
?>
