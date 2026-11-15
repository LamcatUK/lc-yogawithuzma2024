<?php
/* SESSION CARDS */
$class = $block['className'] ?? 'py-5';

if (! function_exists('lc_sub')) {
    /**
     * Safe sub-field getter: always returns a string (or $default) rather than false/null/array.
     */
    function lc_sub(string $name, string $default = ''): string
    {
        $v = get_sub_field($name);
        return is_string($v) && trim($v) !== '' ? $v : $default;
    }
}

if (! have_rows('cards')) {
    return;
}
?>
<section class="three_col">
    <div class="container-xl <?=esc_attr($class)?>">
        <div class="row g-4 justify-content-center">
            <?php
            while (have_rows('cards')) {
                the_row();

                $location = lc_sub('location');
                $dates = lc_sub('dates');
                if ($location === '' && $dates === '') {
                    continue;
                }

                $address = lc_sub('address');
                $directions = lc_sub('directions');
                $notes = lc_sub('notes');
                $pricing = lc_sub('pricing');

                // ACF returns '' / false when empty, or a bare URL string if the return format changes.
                $l = get_sub_field('enquire_link');
                if (is_string($l) && $l !== '') {
                    $l = ['url' => $l, 'title' => ''];
                }
                $has_link = is_array($l) && ! empty($l['url']);
                ?>
            <div class="col-md-6 col-lg-4">
                <div class="session_card bg-ivory rounded-lg h-100">
                    <?php if ($location !== '') { ?>
                    <div class="h3 text-purple-400 text-center">
                        <?=esc_html($location)?>
                    </div>
                    <?php } ?>
                    <?php if ($dates !== '') { ?>
                    <div class="text-center fw-500">
                        <?=esc_html($dates)?>
                    </div>
                    <?php } ?>
                    <?php if ($address !== '' || $directions !== '') { ?>
                    <div class="text-center text-pretty align-self-center flex-column fs-300 mb-2">
                        <?=wp_kses_post($address)?><br>
                        <?php if ($directions !== '') { ?>
                        <a href="<?=esc_url($directions)?>"
                            target="_blank" rel="noopener"><i class="fa-solid fa-map-marker-alt"></i> Get Directions</a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <?php if ($notes !== '') { ?>
                    <div class="text-center text-balance align-self-center mb-2 fw-500">
                        <?=wp_kses_post($notes)?>
                    </div>
                    <?php } ?>
                    <?php if ($pricing !== '') { ?>
                    <div class="text-center fw-500 text-purple-400 text-balance">
                        <?=wp_kses_post($pricing)?>
                    </div>
                    <?php } ?>
                    <?php if ($has_link) { ?>
                    <div class="text-center">
                        <a href="<?=esc_url($l['url'])?>"
                            class="btn btn-primary"><?=esc_html(! empty($l['title']) ? $l['title'] : 'Enquire')?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php
            }
?>
        </div>
    </div>
</section>
