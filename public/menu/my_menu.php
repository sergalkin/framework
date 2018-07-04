<li class="test">
    <a href="?id=<?= $id; ?>"><?= $node['title']; ?></a>
    <?php if (isset($node['childs'])): ?>
        <ul>
            <?= $this->getMenuHtml($node['childs']); ?>
        </ul>
    <?php endif; ?>
</li>