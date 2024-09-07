<?php
/* SESSION CARDS */
$class = $block['className'] ?? 'py-5';
?>
<section class="three_col">
    <div class="container-xl <?=$class?>">
        <div class="row g-4 justify-content-center">
            <?php
            while (have_rows('cards')) {
                the_row();
                $l = get_sub_field('enquire_link');
                ?>
            <div class="col-md-6 col-lg-4">
                <div class="session_card bg-ivory rounded-lg h-100">
                    <div class="h3 text-purple-400 text-center">
                        <?=get_sub_field('location')?>
                    </div>
                    <div class="text-center fw-500">
                        <?=get_sub_field('dates')?>
                    </div>
                    <div class="text-center text-pretty align-self-center flex-column fs-300 mb-2">
                        <?=get_sub_field('address')?><br>
                        <?php
                        if (get_sub_field('directions') ?? null) {
                            ?>
                        <a href="<?=get_sub_field('directions')?>"
                            target="_blank"><i class="fa-solid fa-map-marker-alt"></i> Get Directions</a>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="text-center text-balance align-self-center mb-2 fw-500">
                        <?=get_sub_field('notes')?>
                    </div>
                    <div class="text-center fw-500 text-purple-400 text-balance">
                        <?=get_sub_field('pricing')?>
                    </div>
                    <div class="text-center">
                        <a href="<?=$l['url']?>"
                            class="btn btn-primary"><?=$l['title']?></a>
                    </div>
                </div>
            </div>
            <?php
            }
?>
        </div>
    </div>
</section>