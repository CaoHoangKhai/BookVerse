<?php
class Lien_he extends Controller
{
    function default()
    {
        $this->view("single_layout", [
            "Title" => "Liên hệ",
            "Page" => "common/contact",
        ]);
    }
}
?>