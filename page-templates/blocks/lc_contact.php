<section class="contact">
    <div class="container-xl">
        <div class="row g-5 justify-content-center">
            <div class="col-md-6">
                <h2 class="text-purple-400 h3">Get in touch</h2>
                <div class="mb-4">
                    <?=get_field('intro')?></div>
                <div class="mb-2"><i class="fa-solid fa-phone"></i>
                    <?=contact_phone()?>
                </div>
                <div class="mb-4"><i class="fa-solid fa-paper-plane"></i>
                    <?=contact_email()?>
                </div>
                <div class="h4 text-purple-400">Connect</div>
                <div class="fs-500"><?=social_icons_inline()?></div>
            </div>
            <div class="col-md-6">
                <iframe
                    src="<?=get_field('maps_url', 'options')?>"
                    width="100%" height="450" class="rounded-lg shadow-1" style="border:0;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6">
                <h2 class="h3 text-center text-purple-400 mb-4">Send me a message</h2>
                <?=do_shortcode('[contact-form-7 id="' . get_field('form_id') . '"]')?>
            </div>
        </div>
    </div>
</section>