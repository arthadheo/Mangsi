<div class="card-footer">
    <h6>Your points : <?= $this->session->userdata('point') ?> pts</h6>
</div>

<div class="container">
    <h2 class="mt-4 mb-1">Coupon</h2>

    <div class="row">

        <!-- NANTI CARDNYA DI FOR YA SEBANYAK VOUCHER DI DATABASE -->
        <?php foreach($coupon as $row): ?>
        <div class="col-lg-4 col-md-6 mb-4 my-4">
            <div class="card h-100">
                <h5 class="my-1 mx-1"><?= $row['nama_coupon'] ?></h5>
                <a href="coupon_detail?id=<?= $row['id_coupon']; ?>"><img class="card-img-top" src="dist/images/coupon/<?php echo $row['gambar_coupon']; ?>" alt=""></a>
                <div class="card-footer">
                    <small class="text-right text-muted"><?= $row['harga_coupon'] ?></small>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <!-- FOR NYA SAMPE SINI AJA -->

    </div>
</div>

</div>
<!-- /.container -->
</div>
<!-- /#page-content-wrapper -->

</div>