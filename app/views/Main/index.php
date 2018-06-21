<div class="container">
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="card">
                <h5 class="card-header">Posts</h5>
                <div class="card-body">
                    <h5 class="card-title"><?= $post['title'] ?></h5>
                    <p class="card-text"><?= $post['text'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>