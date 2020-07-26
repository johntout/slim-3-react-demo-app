<?php if (!empty($messages)) : ?>
    <?php foreach($messages as $type => $msgs) : ?>
        <?php foreach($msgs as $msg) : ?>
            <div class="alert alert-<?= $type ?>">
                <button class="close" data-close="alert"></button>
                <span> <?= $msg ?> </span>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endif; ?>