<?php
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $get_user = get('user', 'WHERE email="' . $email . '"');
    $data_user = mysqli_fetch_assoc($get_user);
    $role = $data_user['role'];

    if ($role == 'seller') {
        $page = "seller_index";
    }
} else {
    $page = "";
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

switch ($page) {
        // SELLER
    case 'seller_index':
        include 'page/seller/index.php';
        break;
    case 'seller_view':
        include 'page/seller/view.php';
        break;
    case 'product_add':
        include 'page/seller/product/add.php';
        break;
    case 'seller_product':
        include 'page/seller/product/list.php';
        break;
    case 'seller_product_list':
        include 'page/seller/list.php';
        break;

        // ACCOUNT
    case 'register':
        include 'page/register.php';
        break;
    case 'login':
        include 'page/login.php';
        break;
    case 'log-out':
        log_out();
        break;
    case 'view_profile':
        include 'page/profile/view.php';
        break;
    case 'edit_profile':
        include 'page/profile/edit.php';
        break;
    case 'delete_profile':
        include 'page/profile/delete.php';
        break;

    case 'cart_list':
        include 'page/cart/list.php';
        break;
    case 'cart_add':
        include 'page/cart/add.php';
        break;
    case 'cart_delete':
        include 'page/cart/delete.php';
        break;

    case 'order':
        include 'page/order.php';
        break;
    case 'checkout':
        include 'page/checkout/checkout.php';
        break;
    case 'checkout_confirm':
        include 'page/checkout/confirm.php';
        break;

    case 'review_add':
        include 'page/review/add.php';
        break;
    case 'review_edit':
        include 'page/review/edit.php';
        break;
    case 'review_delete':
        include 'page/review/delete.php';
        break;
    case 'review_submit':
        include 'page/review/submit.php';
        break;

    case 'review_helpful_add':
        include 'page/review/helpful/add.php';
        break;
    case 'review_helpful_delete':
        include 'page/review/helpful/delete.php';
        break;

    case 'wishlist_list':
        include 'page/wishlist/list.php';
        break;
    case 'wishlist_add':
        include 'page/wishlist/add.php';
        break;
    case 'wishlist_delete':
        include 'page/wishlist/delete.php';
        break;

    case 'history_list':
        include 'page/history/list.php';
        break;
    case 'history_add':
        include 'page/history/add.php';
        break;

        // MAIN
    case 'home':
        include 'page/home.php';
        break;
    case 'list':
        include 'page/list.php';
        break;

        // ADMIN
    case 'admin':
        include 'page/admin/index.php';
        break;

    case 'product_list':
        include 'page/product/list.php';
        break;
    case 'product_view':
        include 'page/product/view.php';
        break;
    case 'product_edit':
        include 'page/product/edit.php';
        break;
    case 'product_delete':
        include 'page/product/delete.php';
        break;

    case 'discussion_add':
        include 'page/discussion/add.php';
        break;
    case 'discussion_list':
        include 'page/discussion/list.php';
        break;

    case 'category_list':
        include 'page/categories/list.php';
        break;
    case 'category_delete':
        include 'page/categories/delete.php';
        break;

    case 'category_add':
        include 'page/categories/category/add.php';
        break;
    case 'category_edit':
        include 'page/categories/category/edit.php';
        break;

    case 'subcategory_add':
        include 'page/categories/subcategory/add.php';
        break;
    case 'subcategory_edit':
        include 'page/categories/subcategory/edit.php';
        break;

    case 'sale_list':
        include 'page/sale/list.php';
        break;
    case 'sale_add':
        include 'page/sale/add.php';
        break;
    case 'sale_edit':
        include 'page/sale/edit.php';
        break;
    case 'sale_delete':
        include 'page/sale/delete.php';
        break;

    case 'manifacturer_list':
        include 'page/manifacturer/list.php';
        break;
    case 'manifacturer_add':
        include 'page/manifacturer/add.php';
        break;
    case 'manifacturer_edit':
        include 'page/manifacturer/edit.php';
        break;
    case 'manifacturer_delete':
        include 'page/manifacturer/delete.php';
        break;

    case 'report_product_list':
        include 'page/report/product/list.php';
        break;
    case 'report_product_add':
        include 'page/report/product/add.php';
        break;
    case 'report_product_accept':
        include 'page/report/product/accept.php';
        break;
    case 'report_product_ignore':
        include 'page/report/product/ignore.php';
        break;

    case 'report_review_list':
        include 'page/report/review/list.php';
        break;
    case 'report_review_add':
        include 'page/report/review/add.php';
        break;
    case 'report_review_accept':
        include 'page/report/review/accept.php';
        break;
    case 'report_review_ignore':
        include 'page/report/review/ignore.php';
        break;

        //  BLOG
    case 'blog':
        include 'page/blog/index.php';
        break;

        // OTHER
    case 'about':
        include 'page/about.php';
        break;
    case 'terms':
        include 'page/terms.php';
        break;
    case 'help':
        include 'page/help.php';
        break;
    case '404':
        include 'page/404.php';
        break;

        // DEFAULT
    default:
        include 'page/home.php';
        break;
}
