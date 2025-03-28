<?php
class Tin_tuc extends Controller
{
    function default()
    {
        $this->view("single_layout", [
            "Title" => "Tin Tức",
            "Page" => "news/news",
        ]);
    }
}
?>