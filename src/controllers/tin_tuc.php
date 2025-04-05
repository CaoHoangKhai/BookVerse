<?php
class Tin_tuc extends Controller
{
    private $NewsModel;
    public function __construct()
    {
        parent::__construct();
        $this->NewsModel = $this->model("NewsModel");
    }
    function default()
    {
        $this->view("single_layout", [
            "Title" => "Tin Tức",
            "Page" => "news/news",
            "News" => $this->NewsModel->getNewsHome(),
        ]);
    }

    function detail($link_news)
    {
        $news = $this->NewsModel->getNewsByLink($link_news);
        if (!$news) {
            $this->view("single_layout", [
                "Title" => "Tin Tức",
                "Page" => "error/404",
            ]);
            return;
        }
        $this->view("single_layout", [
            "Title" => $news["title"],
            "Page" => "news/news_detail",
            "NewsDetail" => $news,
            "NewsList" =>$this->NewsModel->getNewsHome(),
            "NewsId" => $news["new_id"], // Truyền ID bài viết sang view
        ]);
    }
}
?>