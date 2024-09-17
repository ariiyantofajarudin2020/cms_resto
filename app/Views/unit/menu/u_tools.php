<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); $p7=''; ?>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="row">

            <!-- body -->
            <div class="col-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">MENU TOOLS<span>| <?=$induk['induk_perusahaan']?></span></h5>
                        <div class="row">
                            <div class="col-9">
                                <div class="row">
                                    <?php
                                    //compare fitur unit dengan fitur yang ada di halaman utama
                                        $i=1;
                                        foreach ($fiturs as $u):
                                            switch ($u['id_fitur']) {
                                                case 'k4f10':
                                                case 'k3f4':   $fitur[$i]= 'x'; break;
                                                default:        $fitur[$i]=''; break;
                                            }
                                            $i++;
                                        endforeach;
                                        $i=1;
                                        foreach ($fiturs as $u):
                                            if ($fitur[$i] != ''): 
                                                //tampilkan sub menu (fitur) yang dimiliki oleh unit ?>
                                    <!-- sub menu -->
                                    <div class="col-6">
                                        <a
                                            href="<?=base_url('/u/'.$unit['wildcard'].'?menu='.$page.'&submenu='.$u['id_fitur'])?>">
                                            <button type="submit" class="btn btn-outline-dark menu">
                                                <i class="bi bi-moon-stars"></i>
                                                <b>
                                                    <?=$u['fitur']?>
                                                </b>
                                            </button>
                                        </a>
                                    </div>
                                    <?php 
                                            endif;
                                            $i++;
                                        endforeach;?>

                                </div>
                            </div>
                            <div class="col-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Sales Card -->

        </div>
    </section>
</main><!-- End #main -->

<?= $this->endSection() ?>