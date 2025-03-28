<?php
class Chinh_sach extends Controller
{
    function default($Policy)
    {
        switch ($Policy) {
            case "chinh-sach-doi-tra-hang":
                $title = "Chính sách đổi trả hàng";
                break;
            case "chinh-sach-bao-hanh":
                $title = "Chính sách bảo hành";
                break;
            case "chinh-sach-thanh-toan":
                $title = "Chính sách thanh toán";
                break;
            case "chinh-sach-van-chuyen":
                $title = "Chính sách vận chuyển";
                break;
                case "chinh-sach-bao-mat-thong-tin":
                    $title = "Chính sách bảo mật thông tin";
                    break;
            default:
                $title = "Chính sách chung";
                break;
        }
        $this->view("single_layout", [
            "Title" => $title,
            "Policy" => $Policy,
            "Page" => "policy/$Policy",
        ]);
    }
}
?>