<option value="<?= $id; ?>"><?= $tab . $node['title']; ?></option>
<?php if (isset($node['childs'])): ?>
    <?= $this->getMenuHtml($node['childs'],'&nbsp;' . $tab . '-'); ?>
<?php endif; ?>