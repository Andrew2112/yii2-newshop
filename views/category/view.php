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
            <?php if (!empty($category)) : ?>
            <div class="w3ls_w3l_banner_nav_right_grid1">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-3 w3ls_w3l_banner_left">
                        <div class="hover14 column">
                            <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                                <div class="agile_top_brand_left_grid_pos">
                                    <?php if ($product->is_offer): ?>
                                        <?= Html::img('@web/images/offer.png', ['alt' => 'offer', 'class="img-responsive"']) ?>
                                    <?php endif; ?>
                                </div>
                                <div class="tag">
                                    <?php if ($product->gift): ?>
                                        <?= Html::img('@web/images/tag.png', ['alt' => 'Подарок', 'class' => "img-responsive"]) ?>
                                    <?php endif; ?>
                                </div>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block">
                                            <div class="snipcart-thumb">
                                                <a href="<?= \yii\helpers\Url::to(['product/view', 'alias' => $product->alias]) ?>">

                                                    <?= Html::img("@web/{$product->img}", ['alt' => $product->title, 'class' => "img-responsive"]) ?></a>

                                                <p><?= $product->title; ?></p>
                                                <h4>$ <?= $product->price; ?>
                                                    <span> <?php if ((float)$product->old_price > 0) echo '$' . $product->old_price; ?></span>
                                                </h4>
                                            </div>

                                            <div class="snipcart-details">
                                                <a href="<?=\yii\helpers\Url::to(['cart/add', 'id'=>$product->id])?>" type="submit"  class="button add-to-cart" data-id="<?=$product->id?>">Add to cart</a>
                                            </div>
                                        </div>
                                    </figure>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

                <?php else: ?>
                    <div class="col-md-3 w3ls_w3l_banner_left">
                        <h6>Товары скоро появятся</h6>
                    </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <?= \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                    ]); ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- //banner -->