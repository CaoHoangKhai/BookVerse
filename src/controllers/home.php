<?php
class Home extends Controller
{
    private $ProductModel;
    private $NewsModel;
    private $SearchModel;
    public function __construct()
    {
        parent::__construct();
        $this->ProductModel = $this->model("ProductModel");
        $this->NewsModel = $this->model("NewsModel");
        $this->SearchModel = $this->model("SearchModel");
    }
    function default()
    {
        $searchName = isset($_GET['search_name']) ? $_GET['search_name'] : null;

        if ($searchName) {
            $bookList = $this->SearchModel->searchBookByName($searchName);
            $pageToShow = "search/book_name"; // View khi có tìm kiếm
        } else {
            $bookList = $this->ProductModel->bookHome();
            $pageToShow = "home/home"; // View mặc định
        }

        $this->view("single_layout", [
            "Title" => "Trang Chủ - Sách",
            "Page" => $pageToShow,
            "BookHome" => $bookList,
            "NewsHome" => $this->NewsModel->getNewsHome(),
        ]);
    }


}
?>