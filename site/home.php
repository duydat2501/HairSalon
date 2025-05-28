 <?php require_once "layout/slider.php"; ?>
 <?php
    $service1 = service_list_limit(0, 5);
    $service2 = service_list_limit(5, 5);
    $gallery = library_list_limit(0, 5);
    $barber = barber_limit(0, 4);
    $setting = list_limit_setting();
    ?>
 <!-- about_area_start -->
 <div class="about_area">
     <div class="container">
         <div class="row align-items-center">
             <div class="col-xl-6 col-lg-6">
                 <div class="about_thumb">
                     <img src="images/about/about_lft.png" alt="" />
                     <div class="opening_hour text-center">
                         <i class="flaticon-clock"></i>
                         <h3>Giờ hoạt động</h3>
                         <p>
                             Mon-Fri (8.30-20.00) <br />
                             Sat (9.00-5.00)
                         </p>
                     </div>
                 </div>
             </div>
             <div class="col-xl-6 col-lg-6">
                 <div class="about_info">
                     <div class="section_title mb-20px">
                         <span>Về chúng tôi</span>
                         <h3><?=$setting['slogan']?></h3>
                     </div>
                     <p>
                         Truyền cảm hứng cùng sự tậm tâm với khách hàng cho các nhân viên
                         của chúng tôi . Chúng tối đã sẵn sàng mang đến cho bạn dịch vụ
                         tốt nhất từ trước đến nay.
                     </p>
                     <a href="#test-form" class="boxed-btn3 popup-with-form">Đặt Lịch Ngay</a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- about_area_end -->
 <div class="service_area">
     <div class="container">
         <div class="row">
             <div class="col-xl-12">
                 <div class="section_title2 text-center mb-90">
                     <i class="flaticon-scissors"></i>
                     <h3>Dịch vụ của chúng tôi</h3>
                 </div>
             </div>
         </div>
         <div class="white_bg_pos">
             <div class="row">
                 <div class="col-xl-6">
                     <?php foreach ($service1 as $s1) : ?>
                         <div class="single_service d-flex justify-content-between align-items-center">
                             <div class="service_inner d-flex align-items-center">
                                 <div class="thumb">
                                     <img src="images/products/<?= $s1['images'] ?>" class="rounded-circle" alt="" width="58" height="58" />
                                 </div>
                                 <span><?= $s1['name'] ?></span>
                             </div>
                             <p>……………………….<?= number_format($s1['price'], 0, ',', '.') . 'đ' ?></p>
                         </div>
                     <?php endforeach; ?>
                 </div>
                 <div class="col-xl-6">
                     <?php foreach ($service2 as $s2) : ?>
                         <div class="single_service d-flex justify-content-between align-items-center">
                             <div class="service_inner d-flex align-items-center">
                                 <div class="thumb">
                                     <img src="images/products/<?= $s2['images'] ?>" class="rounded-circle" alt="" width="58" height="58" />
                                 </div>
                                 <span><?= $s2['name'] ?></span>
                             </div>
                             <p>……………………….<?= number_format($s2['price'], 0, ',', '.') . 'đ' ?></p>
                         </div>
                     <?php endforeach; ?>
                 </div>
             </div>
             <div class="row">
                 <div class="col-xl-12">
                     <div class="book_btn text-center">
                         <a class="boxed-btn3 popup-with-form" href="#test-form">Đặt lịch ngay</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- gallery_area_start -->
 <div class="gallery_area">
     <div class="container">
         <div class="row">
             <div class="col-xl-12">
                 <div class="section_title2 text-center mb-90">
                     <i class="flaticon-scissors"></i>
                     <h3>Bộ sưu tập của chúng tôi</h3>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-xl-12">
                 <div class="gallery_active owl-carousel">
                     <?php foreach ($gallery as $g) : ?>
                         <div class="single_gallery">
                             <div class="thumb">
                                 <img src="images/sliders/<?= $g['images'] ?>" alt="" height="426" />
                                 <div class="image_hover">
                                     <a class="popup-image" href="images/sliders/<?= $g['images'] ?>">
                                         <i class="ti-plus"></i>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     <?php endforeach; ?>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- gallery_area_end -->

 <!-- cutter_muster_start -->
 <div class="cutter_muster">
     <div class="container">
         <div class="row">
             <div class="col-xl-12">
                 <div class="section_title2 text-center mb-90">
                     <i class="flaticon-scissors"></i>
                     <h3>Liststyle của chúng tôi</h3>
                 </div>
             </div>
         </div>
         <div class="row">
             <?php foreach ($barber as $b) : ?>
                 <div class="col-xl-3 col-md-6 col-lg-3">
                     <div class="single_master">
                         <div class="thumb">
                             <img src="images/users/<?= $b['images'] ?>" alt="" />
                         </div>
                         <div class="master_name text-center">
                             <h3><?= $b['name'] ?></h3>
                                 <p>Thợ cắt</p>
                         </div>
                     </div>
                 </div>
             <?php endforeach; ?>
         </div>
     </div>
 </div>
 <!-- cutter_muster_end -->

 <!-- find_us_area start -->
 <div class="find_us_area find_bg_1">
     <div class="container">
         <div class="row">
             <div class="col-xl-5 offset-xl-7 col-lg-6 offset-lg-6">
                 <div class="find_info">
                     <h3 class="find_info_title">Chúng tôi ở đâu?</h3>
                     <div class="single_find d-flex">
                         <div class="icon">
                             <i class="flaticon-placeholder"></i>
                         </div>
                         <div class="find_text">
                             <h3>Địa chỉ</h3>
                             <p>154, Cầu giấy, Hà Nội</p>
                         </div>
                     </div>
                     <div class="single_find d-flex">
                         <div class="icon">
                             <i class="flaticon-phone-call"></i>
                         </div>
                         <div class="find_text">
                             <h3>Gọi cho chúng tôi</h3>
                             <p>+10 378 478 8768</p>
                         </div>
                     </div>
                     <div class="single_find d-flex">
                         <div class="icon">
                             <i class="flaticon-paper-plane"></i>
                         </div>
                         <div class="find_text">
                             <h3>Gửi thư cho chúng tôi</h3>
                             <p>contact@barbershop.com</p>
                         </div>
                     </div>
                     <div class="single_find">
                         <div class="book_btn">
                             <a class="popup-with-form" href="#test-form">Đặt lịch ngay</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- find_us_area_end -->