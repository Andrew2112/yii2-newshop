<li <?php if (isset($category['children'])) echo 'class="dropdown mega-dropdown"' ?>>
    <a href="<?= \yii\helpers\Url::to(['category/view', 'alias' => $category['alias']]) ?>" <?php if (isset($category['children'])) echo 'class="dropdown-toggle" data-toggle="dropdown"' ?>>
        <?= $category['title']; ?>
        <?php if (isset($category['children'])) echo '<span class="caret"></span>' ?>
    </a>
    <?php if (isset($category['children'])): ?>
        <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
            <div class="w3ls_vegetables">
                <ul>
                    <?=$this->getMenuHtml($category['children']) ; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</li>
