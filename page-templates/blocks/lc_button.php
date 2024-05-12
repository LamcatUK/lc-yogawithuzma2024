<?php
$l = get_field('link');
$class = $block['className'] ?? 'py-5';
?>
<section class="button <?=$class?>">
    <div class="container-xl text-center">
        <a href="<?=$l['url']?>"
            target="<?=$l['target']?>"
            class="btn btn-primary"><?=$l['title']?></a>
    </div>
</section>