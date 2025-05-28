<?php
ob_start();
require_once '../golbal.php';
$page = isset($_GET['page']) ? $_GET['page'] : '';
require_once '../libs/categories.php';
require_once '../libs/products.php';
require_once '../libs/gallery.php';
require_once '../libs/types.php';
require_once '../libs/services.php';
require_once '../libs/word_time.php';
require_once '../libs/barbers.php';
require_once '../libs/users.php';
require_once '../libs/news.php';
require_once '../libs/libraries.php';
require_once '../libs/appointments.php';
require_once '../libs/order.php';
require_once "../libs/order-detail.php";
require_once "../libs/app_detail.php";
require_once "../libs/comments.php";
require_once "../libs/evaluates.php";
require_once "../libs/contact.php";
require_once "../libs/setting.php";
$is_json_request = (
    isset($_GET['page'], $_GET['action']) &&
    $_GET['page'] === 'chart' &&
    in_array($_GET['action'], ['order_stats', 'service_stats'])
);


if (!$is_json_request) {
    include_once 'template/header.php';
}

check_role();
switch ($page) {
    case '':
    case 'home':
        include_once 'home/home.php';
        break;
    case 'category':
        //Lấy hành động trong categories
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                //Thêm vào giao diện hiển thị categories
                include_once 'categories/index.php';
                break;
            case 'add':
                include_once 'categories/create.php';
                break;
            case 'edit':
                include_once 'categories/edit.php';
                break;
            case 'search':
                include_once 'categories/search.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'product':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'products/index.php';
                break;
            case 'add':
                include_once 'products/create.php';
                break;
            case 'search':
                include_once 'products/search.php';
                break;
            case 'edit':
                include_once 'products/edit.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'gallery':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'products/gallery/index.php';
                break;
            case 'add':
                include_once 'products/gallery/create.php';
                break;
            case 'edit':
                include_once 'products/gallery/edit.php';
                break;
            case 'delete':
                include_once 'products/gallery/delete.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'type':
        //Lấy hành động trong categories
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                //Thêm vào giao diện hiển thị categories
                include_once 'types/index.php';
                break;
            case 'add':
                include_once 'types/create.php';
                break;
            case 'edit':
                include_once 'types/edit.php';
                break;
        }
        break;
    case 'service':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'services/index.php';
                break;
            case 'add':
                include_once 'services/create.php';
                break;
            case 'search':
                include_once 'services/search.php';
                break;
            case 'edit':
                include_once 'services/edit.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'user':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'users/index.php';
                break;
            case 'add':
                include_once 'users/create.php';
                break;
            case 'search':
                include_once 'users/search.php';
                break;
            case 'edit':
                include_once 'users/edit.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'barber':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'barbers/index.php';
                break;
            case 'add':
                include_once 'barbers/create.php';
                break;
            case 'search':
                include_once 'barbers/search.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;

    case 'time':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'times/index.php';
                break;
            case 'add':
                include_once 'times/create.php';
                break;
            case 'edit':
                include_once 'times/edit.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'new':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'news/index.php';
                break;
            case 'add':
                include_once 'news/create.php';
                break;
            case 'edit':
                include_once 'news/edit.php';
                break;
            case 'search':
                include_once 'news/search.php';
                break;
        }
        break;
    case 'slider':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'libraries/sliders/index.php';
                break;
            case 'add':
                include_once 'libraries/sliders/create.php';
                break;
            case 'edit':
                include_once 'libraries/sliders/edit.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'hair':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'libraries/hairs/index.php';
                break;
            case 'add':
                include_once 'libraries/hairs/create.php';
                break;
            case 'edit':
                include_once 'libraries/hairs/edit.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'appointment':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'appointments/index.php';
                break;
            case 'add':
                include_once 'appointments/create.php';
                break;
            case 'edit':
                include_once 'appointments/edit.php';
                break;
            case 'detail':
                include_once 'appointments/app_detail.php';
                break;
        }
        break;
    case 'order':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'orders/index.php';
                break;
            case 'detail':
                include_once 'orders/order_detail.php';
                break;
            case 'edit':
                include_once 'orders/edit.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'comment':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'feedback/comments/index.php';
                break;
            case 'reply':
                include_once 'feedback/comments/reply.php';
                break;
            case 'edit':
                include_once 'feedback/comments/edit.php';
                break;
            case 'detail':
                include_once 'feedback/comments/detail.php';
                break;
        }
        break;
    case 'contact':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'feedback/contacts/index.php';
                break;
            case 'reply':
                include_once 'feedback/contacts/reply.php';
                break;
            case 'detail':
                include_once 'feedback/contacts/detail.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'evaluate':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case '':
                include_once 'feedback/evaluates/index.php';
                break;
            case 'reply':
                include_once 'feedback/evaluates/reply.php';
                break;
            case 'detail':
                include_once 'feedback/evaluates/detail.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'statistic':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'comment':
                include_once 'statistic/statistic_com.php';
                break;
            case 'product':
                include_once 'statistic/statistic_pro.php';
                break;
            case 'service':
                include_once 'statistic/statistic_ser.php';
                break;
            case 'detail_com':
                include_once 'statistic/detail_com.php';
                break;
            case 'char_pro':
                include_once 'statistic/char_pro.php';
                break;
            case 'char_ser':
                include_once 'statistic/char_ser.php';
                break;
            default:
                include_once "404.php";
                break;
        }
        break;
    case 'chart':
        $action = $_GET['action'] ?? '';

        if ($action == 'order_stats') {
            header('Content-Type: application/json');

            $type = $_GET['type'] ?? 'week';
            switch ($type) {
                case 'week':
                    echo json_encode(get_order_stats_by_week());
                    break;
                case 'month':
                    echo json_encode(get_order_stats_by_month());
                    break;
                case 'year':
                    echo json_encode(get_order_stats_by_year());
                    break;
                default:
                    echo json_encode([]);
            }
            exit; // Important: prevent footer from rendering
        } elseif ($action == 'service_stats') {
            header('Content-Type: application/json');

            $type = $_GET['type'] ?? 'week';
            switch ($type) {
                case 'week':
                    echo json_encode(get_weekly_service_stats());
                    break;
                case 'month':
                    echo json_encode(get_monthly_service_stats());
                    break;
                case 'year':
                    echo json_encode(get_yearly_service_stats());
                    break;
                default:
                    echo json_encode([]);
            }
            exit; // Important: prevent footer from rendering
        }

        // If no action matched:
        include_once "404.php";
        break;
    case 'profile':
        include_once "account/index.php";
        break;
    case 'setting':
        include_once 'setting/setting.php';
        break;
    case 'logout':
        unset($_SESSION['user']);
        header('location:' . ROOT . 'admin/login.php');
        die;
        break;
    default:
        include_once "404.php";
        break;
}

if (!$is_json_request) {
    include_once 'template/footer.php';
}

if (isset($_SESSION['message'])) {
    unset($_SESSION['message']);
}
?>

<?php
ob_end_flush();
