<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!-- Content Begin-->
<section id="main-content" style="margin-left: 0px;">
    <section class="site-min-height">
        <div class="row">

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="panel panel-warning panel-news">
                    <div class="panel-heading">
                        <h1><strong><i class="glyphicon glyphicon-info-sign"></i> <u><?= $news->news_title ?></u></strong></h1>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= $news->news_detail ?>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($listNewsDetail as $index => $img) { ?>
                                <div class="col-lg-6 col-sm-6 col-sm-12">                                
                                    <a class="fancybox" href="<?= $baseUrl . '/images' . $img->img_name ?>">                                       
                                        <img class="img-responsive lazyload" alt="Responsive image"
                                             data-src="<?= $baseUrl . '/images' . $img->img_name ?>">
                                    </a>  
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Sidebar Right Begin-->
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php
                $this->renderPartial('/sidebar_right', array(
                    'listSacredObjectLastInsert' => $listSacredObjectLastInsert,
                    'listSacredType' => $listSacredType,
                    'listMemberLastInsert' => $listMemberLastInsert,
                    'listRegion' => $listRegion
                ))
                ?>
            </div>
            <!-- Sidebar Right End -->

        </div>
    </section>
</section>
