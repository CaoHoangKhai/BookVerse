<?php
class Myerror extends Controller {
    public function default()
    {
        $this->view("error", [
            "Page" => "error/page_404",
            "Title" => "Lỗi !"
        ]);
    }
    public function noRole()
    {
        $this->view("error", [
            "Page" => "error/page_403",
            "Title" => "Lỗi !"
        ]);
    }
}

?>