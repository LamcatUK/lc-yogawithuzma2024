<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
</div> <!-- end page -->
<div id="footer-top"></div>
<footer>
    <div class="footer container-xl pt-5 pb-4">
        <div class="row g-4">
            <div class="col-lg-3 text-center text-lg-start">
                <img src="<?=get_stylesheet_directory_uri()?>/img/ywu-logo--wo.svg"
                    width=146 height=81 class="footer__logo" alt="Yoga with Uzma">
            </div>
            <div class="col-sm-6 col-lg-3 text-center text-lg-start">
                <?php wp_nav_menu(array('theme_location' => 'footer_menu1')); ?>
            </div>
            <div class="col-sm-6 col-lg-3 text-center text-lg-start">
                <?php wp_nav_menu(array('theme_location' => 'footer_menu2')); ?>
            </div>
            <div class="col-lg-3 text-center text-lg-start">
                <div class="mb-2"><i class="fa-solid fa-phone"></i>
                    <?=contact_phone()?>
                </div>
                <div class="mb-2"><i class="fa-solid fa-paper-plane"></i>
                    <?=contact_email()?>
                </div>
                Connect: <?=social_icons_inline()?>
            </div>
        </div>
    </div>
    </div>
    <div class="colophon">
        <div class="container-xl py-2">
            <div class="d-flex flex-wrap justify-content-between">
                <div class="col-md-6 text-center text-md-start">
                    &copy; <?=date('Y')?> Yoga
                    with Uzma
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-end flex-wrap gap-1">
                    <span><a href="/privacy-policy/">Privacy</a> &amp; <a href="/cookie-policy/">Cookies</a></span> |
                    <span>Site by <a href="https://www.lamcat.co.uk/" rel="nofollow noopener"
                            target="_blank">Lamcat</a></span>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer();
if (get_field('gtm_property', 'options')) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=<?=get_field('gtm_property', 'options')?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
}
?>
</body>

</html>