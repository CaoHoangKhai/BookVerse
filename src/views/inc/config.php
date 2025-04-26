<?php
// ==========================
// CẤU HÌNH MENU THEO VAI TRÒ
// ==========================

$admin_links = [
    [
        'label_parent' => 'Bảng Điều Khiển',
        'children' => [
            [
                'icon' => 'fas fa-tachometer-alt',
                'label' => 'Thống kê tổng quan',
                'url' => APP_PATH . '/admin/dashboard',
            ],
        ]
    ],
    [
        'label_parent' => 'Người Dùng',
        'children' => [
            [
                'icon' => 'fas fa-users',
                'label' => 'Danh sách khách hàng',
                'url' => APP_PATH . '/admin/users_list',
            ],
            [
                'icon' => 'fas fa-store',
                'label' => 'Danh sách người bán',
                'url' => APP_PATH . '/admin/sellers_list',
            ],
            [
                'icon' => 'fas fa-user-plus',
                'label' => 'Tạo tài khoản mới',
                'url' => APP_PATH . '/admin/add_user',
            ],
        ],
    ],
    [
        'label_parent' => 'Sản Phẩm',
        'children' => [
            [
                'icon' => 'fas fa-book',
                'label' => 'Quản lý sách',
                'url' => APP_PATH . '/admin/products_list',
            ],
            [
                'icon' => 'fas fa-plus-circle',
                'label' => 'Thêm sách mới',
                'url' => APP_PATH . '/admin/add_product',
            ],
        ]
    ],
    [
        'label_parent' => 'Tin Tức',
        'children' => [
            [
                'icon' => 'fas fa-book',
                'label' => 'Danh sách tin tức',
                'url' => APP_PATH . '/admin/news_list',
            ],
            [
                'icon' => 'fas fa-plus-circle',
                'label' => 'Thêm tin mới',
                'url' => APP_PATH . '/admin/add_news',
            ],
        ]
    ],
    [
        'label_parent' => 'Đơn Hàng',
        'children' => [
            [
                'icon' => 'fas fa-box',
                'label' => 'Quản lý đơn hàng',
                'url' => APP_PATH . '/admin/orders_list',
            ],
        ]
    ],
    [
        'label_parent' => 'Tác Giả',
        'children' => [
            [
                'icon' => 'fas fa-pencil-alt',
                'label' => 'Danh sách tác giả',
                'url' => APP_PATH . '/admin/authors_list',
            ],
            [
                'icon' => 'fas fa-user-plus',
                'label' => 'Thêm tác giả mới',
                'url' => APP_PATH . '/admin/add_author',
            ],
        ]
    ],
];

$seller_links = [
    [
        'label_parent' => 'Bảng Điều Khiển',
        'children' => [
            [
                'icon' => 'fas fa-tachometer-alt',
                'label' => 'Thống kê tổng quan',
                'url' => APP_PATH . '/seller/dashboard',
            ],
        ]
    ],
    // [
    //     'label_parent' => 'Doanh Thu',
    //     'children' => [
    //         [
    //             'icon' => 'fas fa-chart-line',
    //             'label' => 'Thống kê doanh thu',
    //             'url' => APP_PATH . '/seller/revenue',
    //         ],
    //     ]
    // ],
    [
        'label_parent' => 'Gian Hàng Của Tôi',
        'children' => [
            // [
            //     'icon' => 'fas fa-store',
            //     'label' => 'Quản lý gian hàng',
            //     'url' => APP_PATH . '/seller/store',
            // ],
            [
                'icon' => 'fas fa-box',
                'label' => 'Xử lý đơn hàng',
                'url' => APP_PATH . '/seller/my_orders',
            ],
        ]
    ],
    [
        'label_parent' => 'Quản Lý Sách',
        'children' => [
            [
                'icon' => 'fas fa-book',
                'label' => 'Danh sách sách đã đăng',
                'url' => APP_PATH . '/seller/my_books',
            ],
            [
                'icon' => 'fas fa-plus-circle',
                'label' => 'Đăng sách mới',
                'url' => APP_PATH . '/seller/add_book',
            ],
        ]
    ],
    [
        'label_parent' => 'Tin Tức Của Tôi',
        'children' => [
            [
                'icon' => 'fas fa-book',
                'label' => 'Danh sách bài viết',
                'url' => APP_PATH . '/seller/my_news',
            ],
            [
                'icon' => 'fas fa-plus-circle',
                'label' => 'Tạo bài viết mới',
                'url' => APP_PATH . '/seller/add_new',
            ],
        ]
    ],
];

$user_links = [
    [
        'label_parent' => 'Hồ sơ cá nhân',
        'children' => [
            [
                'icon' => 'fa-solid fa-user-circle', // biểu tượng hồ sơ người dùng
                'label' => 'Hồ sơ của tôi',
                'url' => APP_PATH . '/user/profile',
            ],
            [
                'icon' => 'fas fa-heart', // trái tim có dấu check - yêu thích
                'label' => 'Sách yêu thích',
                'url' => APP_PATH . '/user/favorite',
            ],
            [
                'icon' => 'fa-solid fa-location-dot', // biểu tượng định vị địa chỉ
                'label' => 'Địa chỉ của tôi',
                'url' => APP_PATH . '/user/location',
            ],
        ]
    ],
    [
        'label_parent' => 'Hoạt động của tôi',
        'children' => [
            [
                'icon' => 'fa-solid fa-cart-shopping', // icon giỏ hàng
                'label' => 'Giỏ hàng của tôi',
                'url' => APP_PATH . '/auth/cart',
            ],
            [
                'icon' => 'fa-solid fa-box-open', // biểu tượng đơn hàng đã mở
                'label' => 'Đơn hàng của tôi',
                'url' => APP_PATH . '/user/order',
            ],
            // [
            //     'icon' => 'fa-solid fa-star-half-stroke', // biểu tượng đánh giá
            //     'label' => 'Đánh giá của tôi',
            //     'url' => APP_PATH . '/user/comment',
            // ],
        ]
    ],
];


// ==========================
// Cấu hình danh sách footer
// ==========================

$footer_links = [
    "LIÊN KẾT NHANH" => [
        ["Sách Thiếu Nhi", APP_PATH . "/danh_muc/thieu_nhi"],
        ["Sách Chữ Ký", "#"],
        ["Sách Giới Hạn", "#"],
        ["Sách Bán Chạy", "#"],
        ["Combo Sách Hay", "#"]
    ],
    "HỖ TRỢ KHÁCH HÀNG" => [
        ["Hướng Dẫn Mua Hàng", APP_PATH . "/chinh_sach/huong-dan-mua-hang"],
        ["Chính Sách Đổi Trả", APP_PATH . "/chinh_sach/chinh-sach-doi-tra-hang"],
        ["Chính Sách Bảo Hành", APP_PATH . "/chinh_sach/chinh-sach-bao-hanh"],
        ["Chính Sách Vận Chuyển/Thanh Toán", APP_PATH . "/chinh_sach/chinh-sach-van-chuyen-va-thanh-toan"],
        ["Chính Sách Bảo Mật Thông Tin", APP_PATH . "/chinh_sach/chinh-sach-bao-mat-thong-tin"],
    ],
    "CHĂM SÓC KHÁCH HÀNG" => [
        ["Liên Hệ Hỗ Trợ", APP_PATH . "/lien_he"],
        ["Hệ Thống Cửa Hàng", "#"],
        ["Tin Tuyển Dụng", "#"]
    ]
];
?>