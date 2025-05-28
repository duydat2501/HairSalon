<?php
ob_start();
require_once "golbal.php";
require_once "libs/libraries.php";
require_once "libs/users.php";
require_once "libs/barbers.php";
require_once "libs/services.php";
require_once "libs/products.php";
require_once "libs/categories.php";
require_once "libs/types.php";
require_once "libs/news.php";
require_once "libs/gallery.php";
require_once "libs/word_time.php";
require_once "libs/setting.php";
require_once "libs/cart.php";
require_once "libs/comments.php";
require_once "libs/appointments.php";
require_once "libs/app_detail.php";
require_once "libs/order.php";
require_once "libs/order-detail.php";
require_once "libs/contact.php";
require_once "libs/evaluates.php";


extract($_REQUEST);
$page = isset($_GET['page']) ? $_GET['page'] : '';
switch ($page) {
    case '':
    case 'home':
        $view_page = "site/home.php";
        break;
    case 'product-detail':
        $pro = product_list_one('id',$id);
        $title = $pro['name'];
        $view_page = "site/product-detail.php";
        break;
    case 'product-list':
        $view_page = "site/product-list.php";
        break;
    case 'pro-list':
        $view_page = "site/pro-list.php";
        break;
    case 'cart':
        $view_page = "site/cart.php";
        break;
    case 'checkout':
        $view_page = "site/checkout.php";
        break;
    case 'contact':
        $view_page = "site/contact.php";
        break;
    case 'introduce':
        $view_page = "site/introduce.php";
        break;
    case 'service':
        $view_page = "site/service.php";
        break;
    case 'service-list':
        $view_page = "site/service-list.php";
        break;
    case 'blog':
        $view_page = "site/blog.php";
        break;
    case 'blog-detail':
        $blog = list_one_new($id);
        $title = $blog['title'];
        $view_page = "site/blog-detail.php";
        break;
    case 'profile':
        $view_page = "site/profile.php";
        break;
    case 'search':
        $view_page = "site/search.php";
        break;
        case 'search_blog':
            $view_page = "site/search_blog.php";
            break;
    case 'logout':
        unset($_SESSION['barber']);
        unset($_SESSION['user']);
        header('location:' . ROOT);
        die();
        break;
    default:
        $view_page = "site/404.php";
        break;
}
include_once "layout/layout.php";
if (isset($_SESSION['message'])) {
    unset($_SESSION['message']);
}
ob_end_flush();
