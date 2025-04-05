<?php
class Home extends Controller
{
    private $ProductModel;
    private $NewsModel;
    public function __construct()
    {
        parent::__construct();
        $this->ProductModel = $this->model("ProductModel");
        $this->NewsModel = $this->model("NewsModel");
    }
    function default()
    {
        $this->view("single_layout", [
            "Title" => "Trang Chủ - Sách",
            "Page" => "home/home",
            "BookHome" => $this->ProductModel->bookHome(),
            "NewsHome" => $this->NewsModel->getNewsHome(),
        ]);
    }
}
?>