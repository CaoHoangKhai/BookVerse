<?php
class Gioi_Thieu extends Controller
{
    function default()
    {
        $this->view("single_layout", [
            "Title" => "Trang Chủ - Sách",
            "Page" =>"common/gioi_thieu_chung"
        ]);
    }
}
?>