<?php 
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $service =  service_list_cate($id);
$i=0;
$length = count($service);
}
?>
<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay">
 	<h3>Dịch vụ</h3>
 </div>
 <!-- bradcam_area_end -->
 <!-- Dịch vụ -->
<section class="service section-padding">
    <div class="container">
    <div class="row">
  <div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <?php foreach($service as $s): ?>
            <?php if($i==0): ?>
      <a class="nav-link active" id="v-pills-home<?=$s['id']?>-tab" data-toggle="pill" href="#v-pills-home<?=$s['id']?>" role="tab" aria-controls="v-pills-home<?=$s['id']?>" aria-selected="true">
      <img class="rounded-circle mr-2" src="images/products/<?=$s['images']?>" alt="" width="30" height="30"><?=$s['name']?>      
    </a>
            <?php else:?>
      <a class="nav-link" id="v-pills-home<?=$s['id']?>-tab" data-toggle="pill" href="#v-pills-home<?=$s['id']?>" role="tab" aria-controls="v-pills-home<?=$s['id']?>" aria-selected="true">
          <img class="rounded-circle mr-2" src="images/products/<?=$s['images']?>" alt="" width="30" height="30"><?=$s['name']?>
        </a>
      <?php endif;?>
      <?php $i++;
    endforeach; ?>
     
    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent">
    <?php foreach($service as $s): ?>
            <?php if($i==$length): ?>
                <div class="tab-pane fade show active" id="v-pills-home<?=$s['id']?>" role="tabpanel" aria-labelledby="v-pills-home<?=$s['id']?>-tab">
                <h2><?=$s['name']?></h2>
                <p>Giá: <?php if($s['sale']>0):?>
                <span class="old-price">
                <del class="text-gray-400"><?=number_format($s['price'],0,',','.').' đ';?></del>
                </span>
               <?php endif; ?>
              <span class="list-price"><?=number_format($price= $s['price']-($s['price']*$s['sale']),0,',','.').' đ';?></span>
              </p> 
                <p>Thời gian phục vụ dự kiến: <?=$s['time']?></p>
                <?=$s['detail']?>
              </div>
            <?php else:?>
                <div class="tab-pane fade show" id="v-pills-home<?=$s['id']?>" role="tabpanel" aria-labelledby="v-pills-home<?=$s['id']?>-tab">
                <h2><?=$s['name']?></h2>
                <p>Giá: <?php if($s['sale']>0):?>
                <span class="old-price">
                <del class="text-gray-400"><?=number_format($s['price'],0,',','.').' đ';?></del>
                </span>
               <?php endif; ?>
              <span class="list-price"><?=number_format($price= $s['price']-($s['price']*$s['sale']),0,',','.').' đ';?></span>
              </p> 
                <p>Thời gian phục vụ dự kiến: <?=$s['time']?></p>
                <?=$s['detail']?>
              </div>          
      <?php endif;?>
      <?php $i++;
    endforeach; ?>
    </div>
  </div>
</div>
    </div>
</section>
