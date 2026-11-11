<?php

namespace app\components;

use app\models\Order;
use app\models\Subscribe;
use Yii;
use yii\base\Component;
use yii\di\Instance;
use yii\mail\MailerInterface;

/**
 * Отправка почтовых уведомлений сайта (заказы, подписки и т.д.).
 *
 * Подключается в config/web.php как компонент `notifier`:
 *     Yii::$app->notifier->sendOrderCreated($order, $cart);
 *     Yii::$app->notifier->sendSubscribed($subscribe);
 *
 * Ошибки отправки не выбрасываются наружу, а пишутся в лог —
 * сбой почты не должен ломать основное действие пользователя.
 */
class Notifier extends Component
{
    /** @var MailerInterface|array|string мейлер (по умолчанию — компонент `mailer`) */
    public $mailer = 'mailer';

    /** @var string|array отправитель; по умолчанию из params senderEmail/senderName */
    public $from;

    /** @var string|null адрес администратора для копий; по умолчанию params['adminEmail'] */
    public $adminEmail;

    public function init()
    {
        parent::init();
        $this->mailer = Instance::ensure($this->mailer, MailerInterface::class);

        $params = Yii::$app->params;
        if ($this->from === null) {
            $this->from = [$params['senderEmail'] => $params['senderName']];
        }
        if ($this->adminEmail === null) {
            $this->adminEmail = $params['adminEmail'] ?? null;
        }
    }

    /**
     * Отправляет письмо по шаблону из @app/mail.
     *
     * @param string       $view    имя шаблона (например 'order')
     * @param array        $params  переменные для шаблона
     * @param string|array $to      получатель(и)
     * @param string       $subject тема
     * @param bool         $copyToAdmin добавить администратора в получатели
     * @return bool отправлено ли письмо
     */
    public function send(string $view, array $params, $to, string $subject, bool $copyToAdmin = false): bool
    {
        $to = (array)$to;
        if ($copyToAdmin && $this->adminEmail) {
            $to[] = $this->adminEmail;
        }
        $to = array_values(array_unique(array_filter($to)));

        try {
            return $this->mailer
                ->compose($view, $params)
                ->setFrom($this->from)
                ->setTo($to)
                ->setSubject($subject)
                ->send();
        } catch (\Throwable $e) {
            Yii::error("Не удалось отправить письмо '{$view}' на " . implode(', ', $to) . ': ' . $e->getMessage(), __METHOD__);
            return false;
        }
    }

    /**
     * Письмо покупателю (с копией администратору) о новом заказе.
     *
     * @param Order $order сохранённый заказ
     * @param array $cart  позиции корзины: [id => ['title', 'qty', 'price', ...]]
     */
    public function sendOrderCreated(Order $order, array $cart): bool
    {
        return $this->send('order', ['order' => $order, 'cart' => $cart], $order->email, 'Заказ на сайте', true);
    }

    /**
     * Письмо подписчику об оформлении подписки (со ссылкой на отписку).
     */
    public function sendSubscribed(Subscribe $subscribe): bool
    {
        return $this->send('subscribe', ['subscribe' => $subscribe], $subscribe->email, 'Спасибо за подписку на ' . Yii::$app->name);
    }
}
