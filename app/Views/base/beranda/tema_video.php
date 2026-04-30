        <style>
            .tema-video-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: center;
            }

            .tema-video-actions .btn {
                border-radius: 999px !important;
                margin: 0 !important;
                min-width: 112px;
                padding: 9px 18px !important;
                font-weight: 700;
            }

            .tema-video-actions .btn-video-demo {
                background: #ffffff !important;
                border: 1px solid #4bb9e3 !important;
                color: #238ab2 !important;
                box-shadow: 0 8px 20px rgba(75, 185, 227, 0.12);
            }

            .tema-video-actions .btn-video-demo:hover,
            .tema-video-actions .btn-video-demo:focus {
                background: #eefaff !important;
                color: #147391 !important;
            }

            .tema-video-actions .btn-video-order {
                background: #0f766e !important;
                background-image: linear-gradient(45deg, #0f766e 0%, #14b8a6 100%) !important;
                border: 1px solid #0f766e !important;
                color: #ffffff !important;
                box-shadow: 0 10px 24px rgba(15, 118, 110, 0.22);
            }

            .tema-video-actions .btn-video-order:hover,
            .tema-video-actions .btn-video-order:focus {
                background: #0d665f !important;
                background-image: linear-gradient(45deg, #0d665f 0%, #0f9f8f 100%) !important;
                color: #ffffff !important;
            }
        </style>
        <section class="sw-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <h2>Undangan Video</h2>
                        <nav class="breadcrumbs text-center">
                            <ul>
                                <li>
                                    <a href="<?php echo base_url() ?>">Beranda</a>
                                </li>
                                <li class="active">Undangan Video</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- PRODUCT -->
        <section class="sw-container">
            <div id="particle-container">
            </div>
            <div class="container">
                <div class="row" style="margin-bottom: 18px;">
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1 text-center">
                        <p style="margin:0; color:#64748b; line-height:1.8;">
                            Jelajahi kategori video, preview dulu hasilnya, lalu lanjut pesan tema video yang paling sesuai dengan konsep acara kamu.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="isotop-nav text-center" style="margin-bottom: 28px;">
                                <p style="margin:0 0 12px; color:#64748b; font-size:14px;">Filter kategori video:</p>
                                <ul>
                                    <li class="btn sw-button <?php if($link =='all'){ echo 'active'; } ?>"><a href="<?= site_url('tema_video') ?>" >Semua</a></li>
                                    <?php foreach($categories as $category) : ?>
                    				<li class="btn sw-button <?php if($link == $category['slug']) echo 'active'; ?>"><a href="<?= site_url('tema_video?category='.$category['slug']) ?>" ><?= $category['name'] ?></a></li>
                    				<?php endforeach; ?>
                				
                			    </ul>
                            </div>
                        </div>
                    <div class="postList">
                        <?php
                                foreach ($tema_video as $row) { ?>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            
                            <article class="sw-theme">
                                <figure>
                                    <ul class="attribute-list"><li><span class="label-coral"><?= $row->categoryName ?></span></li></ul>
                                    <img src="<?php echo base_url() ?>/assets/themes_video/<?= $row->preview ?>" alt="<?= htmlentities($row->nama_tema) ?>" class="img-responsive"/>
                                </figure>
                                <div class="desc">
                                    <h3><?= htmlentities($row->nama_tema) ?></h3>
                                    <span class="price">
                                        <ins>
                                            <span class="amount">Rp. <?= number_format($row->harga) ?></span>
                                        </ins>
                                    </span>
                                    <div class="readmore text-center tema-video-actions">
                                        <a class="btn sw-button btn-shop-2 btn-shop btn-details btn-demo btn-video-demo" data-link="<?= htmlentities($row->url_video); ?>" data-nama="<?= $row->nama_tema; ?>" title="Lihat Demo Video">Lihat Demo</a>
                                      <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= $setting[0]->no_wa; ?>&text=Assalamualaikum, Kak saya mau pesan Undangan video <?= $row->nama_tema ?>%0ABagaimana cara pesannya kak?" class="btn sw-button btn-shop-2 btn-shop btn-details btn-video-order" title="Pesan Sekarang">Pesan</a>
                                    </div>
                                </div>
                            </article>
                         </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="text-center">
               <?= $pager->links('tema','bootstrap_pagination') ?>
               </div>
            </div>
        </section>
        <div class="modal fade" id="sw-demo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false"
	data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Lihat Demo Video <span class="nama_tema" id="nama_tema"></span></h4>
			</div>
			<div class="modal-body">
				<div class="demo text-center">
					<span class="demo-video" id="demo-video"></span>
				</div>
			</div>
		</div>
	</div>
</div>
