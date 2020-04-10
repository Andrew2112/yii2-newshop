<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<!-- products-breadcrumb -->
<div class="products-breadcrumb">
    <div class="container">
        <ul>
            <li><i class="fa fa-home" aria-hidden="true"></i><a
                    href="<?= Url::home() ?>">Home</a><span>|</span></li>
            <li>
                <a href="<?=Url::to(['category/view', 'id'=>$product->category->id])?>"><?=$product->category->title ; ?></a>
                <span>|</span>
            </li>
            <li><?=$product->title ; ?></li>
        </ul>
    </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
    <?= $this->render('//layouts/inc/sidebar'); ?>
    <div class="w3l_banner_nav_right">
        <div class="w3l_banner_nav_right_banner3">
            <h3>Best Deals For New Products<span class="blink_me"></span></h3>
        </div>
        <div class="agileinfo_single">
            <h5><?=$product->title ; ?></h5>
            <div class="col-md-4 agileinfo_single_left">
              
                <?= Html::img("@web/{$product->img}", ['alt' => $product->title, 'class'=>"img-responsive", 'id'=>'example']) ?>

            </div>
            <div class="col-md-8 agileinfo_single_right">
                <div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked>
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
                </div>
                <div class="w3agile_description">
                    <h4>Description :</h4>
                    <p><?=$product->content ; ?></p>
                </div>
                <div class="snipcart-item block">
                    <div class="quantity-product">
                       Количество: <input type="number" size="4" value="1" name="quantity" min="1" step="1" class="input-text qty text">
                    </div>
                    <div class="snipcart-thumb agileinfo_single_right_snipcart">
                        <h4>Цена: $ <?=$product->price ; ?> <span>$ <?=$product->old_price ; ?></span></h4>
                    </div>
                    <div class="snipcart-details agileinfo_single_right_details">
                        <a href="<?=\yii\helpers\Url::to(['cart/add', 'id'=>$product->id])?>" type="submit"  class="button add-to-cart" data-id="<?=$product->id?>">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<!-- //banner -->
<!-- brands -->
<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_popular">
    <div class="container">
        <h3>Popular Brands Categories</h3>
        <div class="w3ls_w3l_banner_nav_right_grid1">

            <?php foreach ($related as $value) : ?>
            <div class="col-md-3 w3ls_w3l_banner_left">
                <div class="hover14 column">
                    <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">

                        <div class="agile_top_brand_left_grid_pos">
                            <?php if ($value->is_offer): ?>
                                <?= Html::img('@web/images/offer.png', ['alt' => 'offer', 'class="img-responsive"']) ?>
                            <?php endif; ?>

                        </div>
                            <div class="tag">
                                <?php if ($value->gift): ?>
                                    <?= Html::img('@web/images/tag.png', ['alt' => 'Подарок', 'class' => "img-responsive"]) ?>
                                <?php endif; ?>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $value->id]) ?>">

                                                <?= Html::img("@web/{$value->img}", ['alt' => $value->title, 'class' => "img-responsive"]) ?></a>

                                            <p><?= $value->title; ?></p>
                                            <h4>$ <?= $value->price; ?>
                                                <span> <?php if ((float)$value->old_price > 0) echo '$' . $value->old_price; ?></span>
                                            </h4>
                                        </div>

                                        <div class="snipcart-details">
                                            <a href="<?=\yii\helpers\Url::to(['cart/add', 'id'=>$value->id])?>" type="submit"  class="button add-to-cart" data-id="<?=$value->id?>">Add to cart</a>
                                        </div>
                                    </div>
                                </figure>
                            </div>

                    </div>
                </div>

            </div>
            <?php endforeach;?>

            <div class="clearfix"> </div>
        </div>

    </div>
</div>
<!-- //brands -->
