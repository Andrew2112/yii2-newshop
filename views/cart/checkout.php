<?php

use yii\widgets\ActiveForm;

?>
<!-- products-breadcrumb -->

<div class="products-breadcrumb">
    <div class="container">
        <ul>
            <li><i class="fa fa-home" aria-hidden="true"></i> <a
                        href="<?= \yii\helpers\Url::home() ?>">Home</a><span>|</span></li>
            <li>Оформление заказа</li>
        </ul>
    </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
    <?= $this->render('//layouts/inc/sidebar'); ?>
    <div class="w3l_banner_nav_right">
        <!-- about -->
        <div class="privacy about">
            <?php echo \app\widgets\Alert::widget(); ?>
            <?php if (!empty($session['cart'])): ?>
                <h3>Оформление <span>заказа</span></h3>
                <div class="checkout-right">
                    <h4>Your shopping cart contains: <span><?= $session['cart.qty']; ?> Products</span></h4>
                    <div class="cart-table">
                        <div class="overlay">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                        <table class="timetable_sub">
                            <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Фото</th>
                                <th>Кол-во</th>
                                <th>Наименование</th>

                                <th>Цена</th>
                                <th>Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;
                            foreach ($session['cart'] as $id => $item): ?>
                                <tr class="rem1">
                                    <td class="invert"><?= $i; ?></td>
                                    <td class="invert-image"><a
                                                href="<?= \yii\helpers\Url::to(['product/view', 'id' => $id]) ?>"><?= \yii\helpers\Html::img("@web/{$item['img']}", ['alt' => $item['title'], 'height' => 50]); ?></a>
                                    </td>
                                    <td class="invert">
                                        <div class="quantity">
                                            <div class="quantity-select">
                                                <div class="entry value-minus value-change" data-id="<?= $id ?>"
                                                     data-qty="-1">&nbsp;
                                                </div>
                                                <div class="entry value"><span><?= $item['qty']; ?></span></div>
                                                <div class="entry value-plus value-change active" data-id="<?= $id ?>"
                                                     data-qty="1">&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="invert"><?= $item['title']; ?></td>

                                    <td class="invert">$ <?= $item['price']; ?></td>
                                    <td class="invert">
                                        <div class="rem">
                                            <a class="close1"
                                               href="<?= \yii\helpers\Url::to(['cart/del-item', 'id' => $id]) ?>"></a>
                                        </div>

                                    </td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="checkout-left">
                    <div class="col-md-4 checkout-left-basket">

                        <h4>Continue to basket</h4>
                        <ul>
                            <?php foreach ($session['cart'] as $item): ?>
                                <li><?= $item['title']; ?> <i>-</i> <span>$ <?= $item['price'] * $item['qty'] ?> </span>
                                </li>

                            <?php endforeach; ?>
                            <li>Total <i>-</i> <span>$ <?= $session['cart.sum']; ?></span></li>
                        </ul>
                    </div>
                    <div class="col-md-8 address_form_agile">
                        <h4>Данные покупателя</h4>
                        <?php $form = \yii\widgets\ActiveForm::begin(); ?>
                        <?php echo $form->field($order, 'name')->textInput() ?>
                        <?php echo $form->field($order, 'email')->textInput() ?>
                        <?php echo $form->field($order, 'phone')->textInput() ?>
                        <?php echo $form->field($order, 'address')->textInput() ?>
                        <?php echo $form->field($order, 'note')->textarea(['rows' => 5]) ?>
                        <?= \yii\helpers\Html::submitButton('Заказать', ['class' => 'submit check_out']); ?>
                        <?php ActiveForm::end() ?>

                    </div>

                    <div class="clearfix"></div>

                </div>
            <?php else: ?>
                <h3>Корзина пуста</h3>
            <?php endif; ?>
        </div>
        <!-- //about -->
    </div>
    <div class="clearfix"></div>
</div>
<!-- //banner -->
