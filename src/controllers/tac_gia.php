<?php
class Tac_gia extends Controller
{
    public $AuthorModel;

    public function __construct()
    {
        $this->AuthorModel = $this->model("AuthorModel");
        parent::__construct();
    }
    function default($id = null)
    {
        if ($id === null) {
            $getAuthor = $this->AuthorModel->getAllAuthors();
            $this->view("single_layout", [
                "Title" => "Tác Giả",
                "Page" => "authors/author_list",
                "Authors" => $getAuthor,
            ]);
        } else {
            $getAuthor = $this->AuthorModel->getAuthor($id);
            $getBooksByAuthor = $this->AuthorModel->getBooksByAuthorId($id);
            $Author_Name = $getAuthor['Name'] ?? 'Unknown Author';

            $this->view("single_layout", [
                "Title" => $Author_Name,
                "Page" => "authors/author_book",
                "Author" => $getAuthor,
                "Books" => $getBooksByAuthor,
            ]);
        }
    }
}
?>