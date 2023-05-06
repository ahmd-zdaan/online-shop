<?php
$page = "";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

switch ($page) {
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
    case 'view':
        include 'page/profile/view.php';
        break;
    case 'edit':
        include 'page/profile/edit.php';
        break;

        // ADMIN
        case 'admin':
            include 'page/admin/index.php';
            break;

    // MAIN
    case 'home':
        include 'page/home.php';
        break;
    case 'list':
        include 'page/list.php';
        break;

        case 'product_list':
            include 'page/product/list.php';
            break;
        case 'product_add':
            include 'page/product/add.php';
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
                
    case 'category_list':
        include 'page/categories/category/list.php';
        break;
    case 'category_add':
        include 'page/categories/category/add.php';
        break;
    case 'category_edit':
        include 'page/categories/category/edit.php';
        break;
    case 'category_delete':
        include 'page/categories/category/delete.php';
        break;
        
        case 'subcategory_list':
            include 'page/categories/subcategory/list.php';
            break;
        case 'subcategory_add':
            include 'page/categories/subcategory/add.php';
            break;
        case 'subcategory_edit':
            include 'page/categories/subcategory/edit.php';
            break;
        case 'subcategory_delete':
            include 'page/categories/subcategory/delete.php';
            break;

    case 'cart_list':
        include 'page/cart/list.php';
        break;
    case 'cart_delete':
        include 'page/cart/delete.php';
        break;

        case 'order':
            include 'page/order.php';
            break;
        case 'checkout':
            include 'page/checkout.php';
            break;
        case 'review':
            include 'page/review.php';
            break;

    case 'wishlist_list':
        include 'page/wishlist/list.php';
        break;
    case 'wishlist_delete':
        include 'page/wishlist/delete';
        break;
    
    //  BLOG
    case 'blog':
        include 'page/blog/index.php';
        break;

    // OTHER
    case 'about':
        include 'page/about.php';
        break;
    case 'help':
        include 'page/help.php';
        break;
    case '404':
        include 'page/404.php';
        break;
    default:
        include 'page/home.php';
        break;
}
?>