<?php

use yii\helpers\Html;

?>
<!-- products-breadcrumb -->
<div class="products-breadcrumb">
    <div class="container">
        <ul>
            <li><i class="fa fa-home" aria-hidden="true"></i><a
                    href="<?= \yii\helpers\Url::home() ?>">Home</a><span>|</span></li>
            <li><?= $category->title; ?></li>
        </ul>
    </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
    <?= $this->render('//layouts/inc/sidebar'); ?>
    <div class="w3l_banner_nav_right">

        <div class="w3l_banner_nav_right_banner3">
            <?= Html::style(".w3l_banner_nav_right_banner3{ background: url(../{$category->img}) no-repeat 0px 0px; }") ?>
            <h3>Best Deals For New Products<span class="blink_me"></span></h3>
        </div>
        <div class="w3l_banner_nav_right_banner3_btm">
            <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
                <div class="view view-tenth">
                    <?= Html::img("@web/images/13.jpg", ['alt' => 'image', 'class' => "img-responsive"]); ?>

                    <div class="mask">
                        <h4>Grocery Store</h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                    </div>
                </div>
                <h4>Utensils</h4>
                <ol>
                    <li>sunt in culpa qui officia</li>
                    <li>commodo consequat</li>
                    <li>sed do eiusmod tempor incididunt</li>
                </ol>
            </div>
            <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
                <div class="view view-tenth">
                    <?= Html::img("@web/images/14.jpg", ['alt' => 'image', 'class' => "img-responsive"]); ?>

                    <div class="mask">
                        <h4>Grocery Store</h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                    </div>
                </div>
                <h4>Hair Care</h4>
                <ol>
                    <li>enim ipsam voluptatem officia</li>
                    <li>tempora incidunt ut labore et</li>
                    <li>vel eum iure reprehenderit</li>
                </ol>
            </div>
            <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
                <div class="view view-tenth">
                    <?= Html::img("@web/images/15.jpg", ['alt' => 'image', 'class' => "img-responsive"]); ?>

                    <div class="mask">
                        <h4>Grocery Store</h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                    </div>
                </div>
                <h4>Cookies</h4>
                <ol>
                    <li>dolorem eum fugiat voluptas</li>
                    <li>ut aliquid ex ea commodi</li>
                    <li>magnam aliquam quaerat</li>
                </ol>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="w3ls_w3l_banner_nav_right_grid">
            <h3><?= $category->title; ?></h3>
            <?php if (!empty($category)): ?>
                <div class="w3ls_w3l_banner_nav_right_grid1" id="posts-container">
                    <?= $this->render('_items', ['products' => $products]) ?>
                </div>

            <?php else: ?>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <h6>Товары скоро появятся</h6>
                </div>
            <?php endif; ?>
            <div class="col-md-12 category-pagination">
                <?= \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                    'options' => ['class' => 'pagination'],
                ]); ?>
                <?php if ($pages->pageCount > 1): ?>
                    <button id="load-more" class="btn btn-primary" data-page="<?= $pages->getPage() + 1 ?>">Показать
                        ещё</button>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
</div>
<!-- //banner -->
<?php
$url = \yii\helpers\Url::to(['load-more', 'alias' => $category->alias]);
$totalPages = $pages->pageCount;
$this->registerJs(<<<JS
    $('#load-more').on('click', function() {
        var btn = $(this);
        var page = parseInt(btn.attr('data-page')) + 1;
        
        $.ajax({
            url: '$url',
            data: {page: page},
            type: 'GET',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            success: function(data) {
                if (data.trim().length > 0) {
                    $('#posts-container').append(data);
                    btn.attr('data-page', page);
                    if (page >= $totalPages) {
                    btn.hide();
                }
                } else {
                    btn.hide();
                }
            }
        });
    });
JS
);
?>