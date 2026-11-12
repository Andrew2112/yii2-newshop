<?php
use yii\helpers\Html;
?>
<?php
 foreach ($products as $product): ?>
                    <div class="col-md-3 w3ls_w3l_banner_left mb-10">
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
                                                <a href="<?= \yii\helpers\Url::to([
                                                        'product/view',
                                                        'category' => $product->category->alias,
                                                        'alias' => $product->alias,
                                                    ]) ?>">

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