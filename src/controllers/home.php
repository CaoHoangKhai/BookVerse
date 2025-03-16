<?php
class Home extends Controller
{
    function default()
    {
        $this->view("landing", [
            "Title" => "Trang Chủ - Sách",
        ]);
    }
}
?>