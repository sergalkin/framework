<div class="container">
    <?  new fw\widgets\menu\Menu([
            'tpl' => WIDGET_MENU,
            'container' => 'ul',
            'class' => 'my-menu',
            'table' => 'categories',
            'cache' => 60
    ]); ?>
    <? new fw\widgets\menu\Menu([
        'tpl' => WIDGET_SELECT,
        'container' => 'select',
        'class' => 'custom-select custom-select-lg mb-3',
        'table' => 'categories',
        'cache' => 60,
        'cacheKey' => 'select'
    ]); ?>
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="card mb-3 text-dark">
                <h5 class="card-header">Posts</h5>
                <div class="card-body">
                    <h5 class="card-title"><?= $post['title'] ?></h5>
                    <p class="card-text"><?= $post['text'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="text-center">
            <p>Статей: <?= count($posts); ?> из <?= $total; ?></p>
            <?php if ($pagination->countPages > 1): ?>
                <?= $pagination ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <button class="btn btn-outline-primary mb-1 float-right" id="send">Knopka</button>

</div>
<script>
    $('#send').click(function () {
        $.ajax({
            url: '/main/testAjax',
            type: 'post',
            data: {
                'id': 2,
            },
            success: function (res) {
                console.log(res);
            },
            error: function () {
                alert('Error');
            }
        })
    })
</script>