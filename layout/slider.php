   <?php
    $slider = slider_list_limit(0, 5);
    $i=0;
    ?>
   <!-- slider_area_start -->
   <div class="slider_area">
       <div class="container-fluid p-0">
           <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                   <?php foreach ($slider as $s) : ?>
                    <?php if($i==0): ?>
                       <div class="carousel-item active">
                          <div class="overlay2">
                          <a href="<?= ROOT ?>?page=detail&id=40"><img style="height: 100vh;" src="images/sliders/<?= $s['images'] ?>" class="img-fluid d-block w-100" alt="Responsive image"></a>
                           <div class="slider_text text-center">
                               <h3 class="">
                                   <?= $s['name'] ?>
                               </h3>
                               <p>Chăm sóc chuyên nghiệp</p>
                               <div class="book_room">
                                   <div class="book_btn d-lg-block">
                                       <a class="popup-with-form" href="#test-form">Đặt lịch ngay</a>
                                   </div>
                               </div>
                           </div>
                          </div>
                       </div>
                       <?php else:?>
                        <div class="carousel-item">
                          <div class="overlay2">
                          <a href="<?= ROOT ?>?page=detail&id=40"><img style="height: 100vh;" src="images/sliders/<?= $s['images'] ?>" class="img-fluid d-block w-100" alt="Responsive image"></a>
                           <div class="slider_text text-center">
                               <h3 class="">
                                   <?= $s['name'] ?>
                               </h3>
                               <p>Chăm sóc chuyên nghiệp</p>
                               <div class="book_room">
                                   <div class="book_btn d-lg-block">
                                       <a class="popup-with-form" href="#test-form">Đặt lịch ngay</a>
                                   </div>
                               </div>
                           </div>
                          </div>
                       </div>
                       <?php endif; ?>
                   <?php $i++; endforeach; ?>
               </div>
               <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                   <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
                   <span class="sr-only">Next</span>
               </a>
           </div>
       </div>
   </div>
   <!-- slider_area_end -->