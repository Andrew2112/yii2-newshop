<?php
/**
 * Меню боковой панели админки.
 *
 * Пункт:
 *   label      — текст
 *   icon       — класс иконки Font Awesome 4 (без "fa "), например 'cubes'
 *   url        — маршрут внутри модуля admin, например ['order/index']
 *   controller — id контроллера: пункт подсвечивается на любой его странице (для разделов с подменю)
 *   items      — подпункты (label + url)
 *   visible    — необязательно, bool: показывать ли пункт
 */
return [
    ['header' => 'Навигация'],
    [
        'label' => 'Статистика магазина',
        'icon' => 'bar-chart',
        'url' => ['main/index'],
    ],
    [
        'label' => 'Категории',
        'icon' => 'cubes',
        'controller' => 'category',
        'items' => [
            ['label' => 'Список категорий', 'url' => ['category/index']],
            ['label' => 'Добавить категорию', 'url' => ['category/create']],
        ],
    ],
    [
        'label' => 'Заказы',
        'icon' => 'shopping-cart',
        'controller' => 'order',
        'items' => [
            ['label' => 'Список заказов', 'url' => ['order/index']],
            ['label' => 'Добавить заказ', 'url' => ['order/create']],
        ],
    ],
    [
        'label' => 'Товары',
        'icon' => 'cutlery',
        'controller' => 'product',
        'items' => [
            ['label' => 'Список товаров', 'url' => ['product/index']],
            ['label' => 'Добавить товар', 'url' => ['product/create']],
        ],
    ],
    [
        'label' => 'Подписка',
        'icon' => 'envelope',
        'controller' => 'subscribe',
        'items' => [
            ['label' => 'Список подписчиков', 'url' => ['subscribe/index']],
            ['label' => 'Добавить подписчика', 'url' => ['subscribe/create']],
        ],
    ],
];
