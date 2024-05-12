<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
</div> <!-- end page -->
<div id="footer-top"></div>
<footer>
    <div class="footer container-xl pt-5 pb-4">
        <div class="row g-4 mb-4">
            <div class="col-lg-2 text-center text-lg-start">
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
        <div class="row g-4 w-md-75 w-lg-50 mx-auto justify-content-center align-items-center">
            <div class="col-sm-6 col-md-3 text-center">
                <a href="https://www.bwy.org.uk/" target="_blank" rel="nofollow noopener"><img
                        src="<?=get_stylesheet_directory_uri()?>/img/logos/byw-logo.svg"
                        alt="The British Wheel of Yoga"></a>
            </div>
            <div class="col-sm-6 col-md-3 text-center">
                <a href="https://search.cnhcregister.org.uk/search?name=uzma&therapy=&radius=2&city=Weybridge&postcode=KT13+0AG&g-recaptcha-response=03AFcWeA4zPMbMmyo8COWsdFQMO-2cZR_DR6gUdAYXPdaIFzuTZAq_Ka-BRAprAU33fpGT0yDowZHtWDV8WDG5k39472ttMg9431bFgeOT26KdSF_tH-9ER1AE-9je5FtMb_jeC9DxzQF9XLLjAC3050suj8iq-MklPz9DnLqVFupYrF9n4Sf0wdU2sm5_7FYHXiak17QDz1eM6nBkHRZprrjrVAp7bPs_lv7Ld1-nFCFNyzWsGJNL4K8Cj93jV6sU6g3eymif-1nTZbD_-7iSKytY1Md9MIY0VCc8_ons83UTAuQziuRPSrPlh8eB2cjI7k_VeFDw5hkpt9AAD_NEi9XanGsjMmCrzlpArxyVDvZPTmwW5jgRN2iienmhhX4oNApirPFjh3t80LSyTv5cakcqR3tfH8R_Ekab2sBYvqkLX9rM_vamctLechTf8v1XhnNL62ATWcU3I-XtnUFcXkwDsoo7nf4JqmqvSvYToWcC7W2oorcMuwaKNXaQz1EysZJSkMd-FtjukgnDsxNjlRAyXfSW_uoQYtmMg8qzzvj1RcQ_1wDXb6qgnrT7pcvAy3GMIH7jFnF4qJMiApFLX0wUw_I-xJhLLNN-CbE4YRVa6nlDFAY-rULBej46MjDWpvlyvI_CzrISUNsthzQv_RgeXiOG5dImlL2YIsg1Ai-lgXLSWKCONUTeAdF2EpvVS5wE25p5OpGN"
                    target="_blank" rel="nofollow noopener">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/logos/cnhc-accreditation.png"
                        alt="Complementary & Natural Healthcare Council">
                </a>
            </div>
            <div class="col-sm-6 col-md-3 text-center">
                <a href="https://www.tsyp.yoga/find-a-yoga-teacher-near-you/#!biz/id/5f04b2c09501ca5d1971bdfd"
                    target="_blank" rel="noopener nofollow">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/logos/TSYP-Yoga-Teacher.jpg"
                        alt="The Society of Yoga Practitioners">
                </a>
            </div>
            <div class="col-sm-6 col-md-3 text-center">
                <a href="https://www.tsyp.yoga/find-a-yoga-teacher-near-you/#!biz/id/5f04b2c09501ca5d1971bdfd"
                    target="_blank" rel="noopener nofollow">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/logos/TSYP-Yoga-Therapist.jpg"
                        alt="The Society of Yoga Practitioners">
                </a>
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