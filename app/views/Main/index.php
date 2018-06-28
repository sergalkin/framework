<div class="container">
    <button class="btn btn-primary" id="send">Knopka</button>
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