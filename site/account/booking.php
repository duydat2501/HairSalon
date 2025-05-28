<?php
if (isset($_SESSION['barber'])) {
        $booking =  appointment_barber($_SESSION['barber']['id']);
        $booking_early = appointment_barber_status($_SESSION['barber']['id'], 0);
        $booking_wait = appointment_barber_status($_SESSION['barber']['id'], 1);
        $booking_doing = appointment_barber_status($_SESSION['barber']['id'], 2);
        $booking_did = appointment_barber_status($_SESSION['barber']['id'], 3);
        $booking_cancel = appointment_barber_status($_SESSION['barber']['id'], 4);
} else {
    if($_SESSION['user']['role']==3){
        $booking = appointment_user($user['id']);
        $booking_early = appointment_custom_status($user['id'], 0);
        $booking_wait = appointment_custom_status($user['id'], 1);
        $booking_doing = appointment_custom_status($user['id'], 2);
        $booking_did = appointment_custom_status($user['id'], 3);
        $booking_cancel = appointment_custom_status($user['id'], 4);
    }else{
        $booking = list_all_appointment();
        $booking_early = appointment_list_cancel(0);
        $booking_wait = appointment_list_cancel(1);
        $booking_doing = appointment_list_cancel(2);
        $booking_did = appointment_list_cancel(3);
        $booking_cancel = appointment_list_cancel(4);
    }
}
if (isset($_REQUEST['btnUpdate'])) {
    extract($_REQUEST);
    appointment_update($id, 4);
    header('location:' . ROOT . '?page=profile&action=booking');
}
?>
<section class="booking">
    <div class="nav-order">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="false">Tất cả</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Sắp tới</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">Chờ phục vụ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Đang phục vụ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-finish-tab" data-toggle="pill" href="#pills-finish" role="tab" aria-controls="pills-finish" aria-selected="false">Hoàn thành</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-cancel-tab" data-toggle="pill" href="#pills-cancel" role="tab" aria-controls="pills-cancel" aria-selected="false">Đã hủy</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
            <?php if (!empty($booking)) : ?>
                <div class="order mt-5">
                    <?php foreach ($booking as $b) : ?>
                        <div class="text-right align-content-end text-capitalize mb-5 bg-light p-3">
                            <?php if ($b['cancel'] == 0) : ?>
                                Sắp tới
                            <?php elseif ($b['cancel'] == 1) : ?>
                                Chờ phục vụ
                            <?php elseif ($b['cancel'] == 2) : ?>
                                Đang phục vụ
                            <?php elseif ($b['cancel'] == 3) : ?>
                                Hoàn thành
                            <?php else : ?>
                                Đã hủy
                            <?php endif; ?>
                        </div>
                        <div class="row border-bottom pb-2 mb-3">
                            <div class="col-2">
                                <p><?= $b['day'] ?></p>
                            </div>
                            <div class="col-1">
                                <p><?= $b['time'] ?></p>
                            </div>
                            <div class="col-3">
                                <p class="text-center"><?= $b['name'] ?></p>
                            </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['phone'] ?></p>
                                </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['account'] ?></p>
                                </div>
                                <div class="col-2">
                                    <img class="rounded-circle" src="images/users/<?= $b['barber_images'] ?>" alt="Anh barber" width="40" height="40">
                                </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-12 text-right align-content-end">
                                <a href="<?= ROOT ?>?page=profile&action=detail&id=<?= $b['id'] ?>" class="btn btn-success text-uppercase pl-4 pr-4 rounded-0">Chi tiết</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-purchase mt-5 mb-3 pt-5">
                    <div class="purchase"></div>
                    <div class="title text-center">Chưa có lịch hẹn</div>
                </div>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <?php if (!empty($booking_early)) : ?>
                <div class="order mt-5">
                    <?php foreach ($booking_early as $b) : ?>
                        <div class="row border-bottom pb-2 mb-3">
                        <div class="col-2">
                                <p><?= $b['day'] ?></p>
                            </div>
                            <div class="col-1">
                                <p><?= $b['time'] ?></p>
                            </div>
                            <div class="col-3">
                                <p class="text-center"><?= $b['name'] ?></p>
                            </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['phone'] ?></p>
                                </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['account'] ?></p>
                                </div>
                                <div class="col-2">
                                    <img class="rounded-circle" src="images/users/<?= $b['barber_images'] ?>" alt="Anh barber" width="40" height="40">
                                </div>
                        </div>
                        <div class="row mb-5">
                            <?php if (isset($_SESSION['barber'])) : ?>
                                    <div class="col-12 text-right align-content-end">
                                        <a href="<?= ROOT ?>?page=profile&action=detail&id=<?= $b['id'] ?>" class="btn btn-success text-uppercase pl-4 pr-4 rounded-0">Chi tiết</a>
                                    </div>
                                <?php else: ?>
                                    <div class="col-8 text-right align-content-end">
                                    <a href="<?= ROOT ?>?page=profile&action=booking&btnUpdate&id=<?= $b['id'] ?>" class="btn btn-outline-danger text-uppercase pl-4 pr-4 rounded-0">Hủy đơn</a>
                                </div>
                                <div class="col-4 text-right align-content-end">
                                    <a href="<?= ROOT ?>?page=profile&action=detail&id=<?= $b['id'] ?>" class="btn btn-success text-uppercase pl-4 pr-4 rounded-0">Chi tiết</a>
                                </div>
                                <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-purchase mt-5 mb-3 pt-5">
                    <div class="purchase"></div>
                    <div class="title text-center">Chưa có lịch hẹn</div>
                </div>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <?php if (!empty($booking_wait)) : ?>
                <div class="order mt-5">
                    <?php foreach ($booking_wait as $b) : ?>
                        <div class="row border-bottom pb-2 mb-3">
                            <div class="col-2">
                                <p><?= $b['day'] ?></p>
                            </div>
                            <div class="col-1">
                                <p><?= $b['time'] ?></p>
                            </div>
                            <div class="col-3">
                                <p class="text-center"><?= $b['name'] ?></p>
                            </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['phone'] ?></p>
                                </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['account'] ?></p>
                                </div>
                                <div class="col-2">
                                    <img class="rounded-circle" src="images/users/<?= $b['barber_images'] ?>" alt="Anh barber" width="40" height="40">
                                </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-8 text-right align-content-end">
                                <a href="<?= ROOT ?>?page=profile&action=booking&btnUpdate&id=<?= $b['id'] ?>" class="btn btn-outline-danger text-uppercase pl-4 pr-4 rounded-0">Hủy đơn</a>
                            </div>
                            <div class="col-4 text-right align-content-end">
                                <a href="<?= ROOT ?>?page=profile&action=detail&id=<?= $b['id'] ?>" class="btn btn-success text-uppercase pl-4 pr-4 rounded-0">Chi tiết</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-purchase mt-5 mb-3 pt-5">
                    <div class="purchase"></div>
                    <div class="title text-center">Chưa có lịch hẹn</div>
                </div>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <?php if (!empty($booking_doing)) : ?>
                <div class="order mt-5">
                    <?php foreach ($booking_doing as $b) : ?>
                        <div class="row border-bottom pb-2 mb-3">
                            <div class="col-2">
                                <p><?= $b['day'] ?></p>
                            </div>
                            <div class="col-1">
                                <p><?= $b['time'] ?></p>
                            </div>
                            <div class="col-3">
                                <p class="text-center"><?= $b['name'] ?></p>
                            </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['phone'] ?></p>
                                </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['account'] ?></p>
                                </div>
                                <div class="col-2">
                                    <img class="rounded-circle" src="images/users/<?= $b['barber_images'] ?>" alt="Anh barber" width="40" height="40">
                                </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-12 text-right align-content-end">
                                <a href="<?= ROOT ?>?page=profile&action=detail&id=<?= $b['id'] ?>" class="btn btn-success text-uppercase pl-4 pr-4 rounded-0">Chi tiết</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-purchase mt-5 mb-3 pt-5">
                    <div class="purchase"></div>
                    <div class="title text-center">Chưa có lịch hẹn</div>
                </div>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade" id="pills-finish" role="tabpanel" aria-labelledby="pills-finish-tab">
            <?php if (!empty($booking_did)) : ?>
                <div class="order mt-5">
                    <?php foreach ($booking_did as $b) : ?>
                        <div class="row border-bottom pb-2 mb-3">
                            <div class="col-2">
                                <p><?= $b['day'] ?></p>
                            </div>
                            <div class="col-1">
                                <p><?= $b['time'] ?></p>
                            </div>
                            <div class="col-3">
                                <p class="text-center"><?= $b['name'] ?></p>
                            </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['phone'] ?></p>
                                </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['account'] ?></p>
                                </div>
                                <div class="col-2">
                                    <img class="rounded-circle" src="images/users/<?= $b['barber_images'] ?>" alt="Anh barber" width="40" height="40">
                                </div>
                        </div>
                        <div class="row mb-5">
                           
                            <div class="col-12 text-right align-content-end">
                                <a href="<?= ROOT ?>?page=profile&action=detail&id=<?= $b['id'] ?>" class="btn btn-success text-uppercase pl-4 pr-4 rounded-0">Chi tiết</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-purchase mt-5 mb-3 pt-5">
                    <div class="purchase"></div>
                    <div class="title text-center">Chưa có lịch hẹn</div>
                </div>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab">
            <?php if (!empty($booking_cancel)) : ?>
                <div class="order mt-5">
                    <?php foreach ($booking_cancel as $b) : ?>
                        <div class="row border-bottom pb-2 mb-3">
                            <div class="col-2">
                                <p><?= $b['day'] ?></p>
                            </div>
                            <div class="col-1">
                                <p><?= $b['time'] ?></p>
                            </div>
                            <div class="col-3">
                                <p class="text-center"><?= $b['name'] ?></p>
                            </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['phone'] ?></p>
                                </div>
                                <div class="col-2">
                                    <p class="text-center"><?= $b['account'] ?></p>
                                </div>
                                <div class="col-2">
                                    <img class="rounded-circle" src="images/users/<?= $b['barber_images'] ?>" alt="Anh barber" width="40" height="40">
                                </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-12 text-right align-content-end">
                                <a href="<?= ROOT ?>?page=profile&action=detail&id=<?= $b['id'] ?>" class="btn btn-success text-uppercase pl-4 pr-4 rounded-0">Chi tiết</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-purchase mt-5 mb-3 pt-5">
                    <div class="purchase"></div>
                    <div class="title text-center">Chưa có lịch hẹn</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>