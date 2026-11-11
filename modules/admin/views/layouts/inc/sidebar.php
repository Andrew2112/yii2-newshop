<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\Menu;

$controllerId = Yii::$app->controller->id;

/**
 * Приводит пункты из config/menu.php к формату yii\widgets\Menu с разметкой AdminLTE.
 */
$prepare = function (array $config) use ($controllerId) {
    $items = [];
    foreach ($config as $item) {
        if (isset($item['header'])) {
            $items[] = ['label' => $item['header'], 'options' => ['class' => 'header']];
            continue;
        }

        $icon = isset($item['icon']) ? '<i class="fa fa-' . Html::encode($item['icon']) . '"></i> ' : '';
        $label = $icon . '<span>' . Html::encode($item['label']) . '</span>';

        $menuItem = [
            'label' => $label,
            'encode' => false,
            'visible' => $item['visible'] ?? true,
        ];

        if (!empty($item['items'])) {
            $menuItem['url'] = '#';
            $menuItem['options'] = ['class' => 'treeview'];
            $menuItem['template'] = '<a href="{url}">{label}<span class="pull-right-container">'
                . '<i class="fa fa-angle-left pull-right"></i></span></a>';
            $menuItem['items'] = $item['items'];
            if (isset($item['controller'])) {
                $menuItem['active'] = $item['controller'] === $controllerId;
            }
        } else {
            $menuItem['url'] = $item['url'];
        }

        $items[] = $menuItem;
    }
    return $items;
};
?>
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= Html::encode(Yii::$app->user->identity->fio) ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <?= Menu::widget([
            'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
            'items' => $prepare(require Yii::getAlias('@app/modules/admin/config/menu.php')),
            'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
            'activateParents' => true,
        ]) ?>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
