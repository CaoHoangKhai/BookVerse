<?php

// ==========================
// Cấu hình danh sách menu theo vai trò
// ==========================

// 🚀 Danh sách liên kết cho User (Người dùng thông thường)
$user_links = [
    [
        'icon' => 'fas fa-user',
        'label' => 'Hồ sơ của tôi',
        'url' => APP_PATH . '/user/profile',
    ],
    [
        'icon' => 'fas fa-heart',
        'label' => 'Sách yêu thích',
        'url' => APP_PATH . '/user/favorite',
    ],
    [
        'icon' => 'fas fa-shopping-cart',
        'label' => 'Đơn hàng của tôi',
        'url' => APP_PATH . '/user/order',
    ],
    [
        'icon' => 'fa fa-location-dot',
        'label' => 'Địa chỉ của tôi',
        'url' => APP_PATH . '/user/location',
    ],
    [
        'icon' => 'fas fa-comments',
        'label' => 'Đánh giá của tôi',
        'url' => APP_PATH . '/user/comment',
    ],
];

// 🚀 Danh sách liên kết cho Admin (Quản trị viên)
// $admin_links = [
//     [
//         'icon' => 'fas fa-chart-line', 
//         'label' => 'Thống kê Doanh thu', 
//         'url' => APP_PATH . '/admin/dashboard',
//     ],
//     [
//         'icon' => 'fas fa-id-card', 
//         'label' => 'Hồ sơ của tôi',
//         'url' => '#',
//     ],
//     [
//         'icon' => 'fas fa-users', 
//         'label' => 'Quản lý Khách Hàng', 
//         'url' => APP_PATH . '/admin/users_list',
//     ],
//     [
//         'icon' => 'fas fa-store', 
//         'label' => 'Quản lý Nhà Bán Sách',
//         'url' => APP_PATH . '/admin/sellers_list',
//     ],
//     [
//         'icon' => 'fas fa-book',
//         'label' => 'Quản lý Sách',
//         'url' => APP_PATH . '/admin/products_list',
//     ],
//     [
//         'icon' => 'fas fa-box',
//         'label' => 'Quản lý Đơn Hàng',
//         'url' => APP_PATH . '/admin/orders_list',
//     ],
//     [
//         'icon' => 'fas fa-comments',
//         'label' => 'Quản lý Đánh Giá',
//         'url' => '#',
//     ],
//     [
//         'icon' => 'fas fa-book-open',
//         'label' => 'Quản lý Tác Giả',
//         'url' => APP_PATH . '/admin/authors_list',
//     ],
// ];
$admin_links = [
    [
        'label_parent' => 'Quản lý Người Dùng',
        'children' => [
            [
                'icon' => 'fas fa-users',
                'label' => 'Quản lý Khách Hàng',
                'url' => APP_PATH . '/admin/users_list',
            ],
            [
                'icon' => 'fas fa-store',
                'label' => 'Quản lý Nhà Bán Sách',
                'url' => APP_PATH . '/admin/sellers_list',
            ],
            [
                'icon' => 'fas fa-user-plus',
                'label' => 'Thêm Người Dùng',
                'url' => APP_PATH . '/admin/users_list',
            ],
        ],
    ],
    [
        'label_parent' => 'Quản lý Sản Phẩm',
        'children' => [
            [
                'icon' => 'fas fa-book',
                'label' => 'Quản lý Sách',
                'url' => APP_PATH . '/admin/products_list',
            ],
            [
                'icon' => 'fas fa-plus-circle',  // Dùng biểu tượng dấu cộng trong vòng tròn
                'label' => 'Thêm Sách',
                'url' => APP_PATH . '/admin/products_list',
            ],
        ]
    ],
    [
        'label_parent' => 'Quản lý Tác Giả',
        'children' => [
            [
                'icon' => 'fas fa-pencil-alt',  // Biểu tượng bút dùng cho quản lý tác giả
                'label' => 'Quản lý Tác Giả',
                'url' => APP_PATH . '/admin/authors_list',
            ],
            [
                'icon' => 'fas fa-user-plus',  // Biểu tượng dấu cộng cho Thêm Tác Giả
                'label' => 'Thêm Tác Giả',
                'url' => APP_PATH . '/admin/add_author',  // URL Thêm Tác Giả
            ],
        ]
    ],
    [
        'label_parent' => 'Quản lý Tác Giả',
        'children' => [
            [
                'icon' => 'fas fa-pencil-alt',  // Biểu tượng bút dùng cho quản lý tác giả
                'label' => 'Quản lý Tác Giả',
                'url' => APP_PATH . '/admin/authors_list',
            ],
            [
                'icon' => 'fas fa-user-plus',  // Biểu tượng dấu cộng cho Thêm Tác Giả
                'label' => 'Thêm Tác Giả',
                'url' => APP_PATH . '/admin/add_author',  // URL Thêm Tác Giả
            ],
        ]
    ],
    
];


// 🚀 Danh sách liên kết cho Seller (Người bán sách)
$seller_links = [
    [
        'icon' => 'fas fa-chart-line',
        'label' => 'Doanh thu của tôi',
        'url' => APP_PATH . '/seller/revenue',
    ],
    [
        'icon' => 'fas fa-store',
        'label' => 'Quản lý Gian Hàng',
        'url' => APP_PATH . '/seller/store',
    ],
    [
        'icon' => 'fas fa-book',
        'label' => 'Sách của tôi',
        'url' => APP_PATH . '/seller/my_books',
    ],
    [
        'icon' => 'fas fa-box',
        'label' => 'Đơn hàng của tôi',
        'url' => APP_PATH . '/seller/orders',
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