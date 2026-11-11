<?php
/** @var app\models\Subscribe $subscribe */
use yii\helpers\Html;
use yii\helpers\Url;

$siteName = Html::encode(Yii::$app->name);
$homeUrl = Html::encode(Yii::$app->urlManager->createAbsoluteUrl(['/']));
$unsubscribeUrl = Html::encode(Url::to(['/site/unsubscribe', 'token' => $subscribe->token], true));
?>
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f5f5; padding:30px 0; font-family:'Open Sans', Arial, sans-serif;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:6px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.08);">
                <!-- Шапка -->
                <tr>
                    <td style="background:#FA1818; padding:28px 40px; text-align:center;">
                        <a href="<?= $homeUrl ?>" style="color:#ffffff; font-size:24px; font-weight:bold; text-decoration:none; letter-spacing:1px;">
                            <?= $siteName ?>
                        </a>
                    </td>
                </tr>
                <!-- Тело -->
                <tr>
                    <td style="padding:40px;">
                        <h2 style="margin:0 0 20px; color:#212121; font-size:22px; font-weight:600;">
                            Спасибо за подписку!
                        </h2>
                        <p style="margin:0 0 16px; color:#555; font-size:15px; line-height:1.7;">
                            Здравствуйте! Вы успешно подписались на новостную рассылку магазина
                            <strong><?= $siteName ?></strong>.
                        </p>
                        <p style="margin:0 0 16px; color:#555; font-size:15px; line-height:1.7;">
                            Теперь вы первыми будете узнавать о новых поступлениях, акциях и специальных
                            предложениях. Мы обещаем писать только по делу и не спамить.
                        </p>
                        <p style="margin:0 0 28px; color:#555; font-size:15px; line-height:1.7;">
                            Ваш e-mail для подписки: <strong><?= Html::encode($subscribe->email) ?></strong>
                        </p>
                        <table cellpadding="0" cellspacing="0" style="margin:0 auto;">
                            <tr>
                                <td style="background:#84C639; border-radius:4px;">
                                    <a href="<?= $homeUrl ?>"
                                       style="display:inline-block; padding:12px 32px; color:#ffffff; font-size:15px; text-decoration:none; font-weight:600;">
                                        Перейти в магазин
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Подвал -->
                <tr>
                    <td style="background:#212121; padding:20px 40px; text-align:center;">
                        <p style="margin:0; color:#999; font-size:12px; line-height:1.6;">
                            Это письмо отправлено автоматически, отвечать на него не нужно.<br>
                            Вы получили его, потому что подписались на рассылку на сайте <?= $siteName ?>.<br>
                            <a href="<?= $unsubscribeUrl ?>" style="color:#bbb; text-decoration:underline;">Отписаться от рассылки</a><br>
                            &copy; <?= date('Y') ?> <?= $siteName ?>. Все права защищены.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
