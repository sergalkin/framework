<div class="container">
    <button class="btn btn-primary" id="send">Knopka</button>
    <? new \vendor\widgets\menu\Menu([
            'tpl' => WIDGET_MENU,
            'container' => 'ul',
            'class' => 'my-menu',
            'table' => 'categories',
            'cache' => 60
    ]);?>
    <? new \vendor\widgets\menu\Menu([
        'tpl' => WIDGET_SELECT,
        'container' => 'select',
        'class' => 'my-menu',
        'table' => 'categories',
        'cache' => 60,
        'cacheKey' => 'select'
    ]);?>
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="card mb-3">
                <h5 class="card-header">Posts</h5>
                <div class="card-body">
                    <h5 class="card-title"><?= $post['title'] ?></h5>
                    <p class="card-text"><?= $post['text'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<script>
    $('#send').click(function () {
        $.ajax({
            url: '/main/test',
            type: 'post',
            data: {
                'id' : 2,
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