/**
 * ACF 6.8 blocks: clicking "Edit Block" on an unselected block opens the modal and selects the block in the
 * same tick. The sidebar panel then mounts a moment later and re-claims the form, leaving the modal empty.
 * Hold the first click, select the block, wait for the sidebar form to mount, then replay the click.
 */
wp.domReady(function () {
    var attached = new WeakSet();
    var replaying = new WeakSet();
    var MAX_WAIT = 2500;

    function sidebarPanelReady() {
        var sidebar = document.querySelector('.interface-complementary-area');
        // With the sidebar closed there is nothing to race against.
        return !sidebar || !!sidebar.querySelector('.acf-block-panel');
    }

    function attach(doc) {
        if (!doc || attached.has(doc)) {
            return;
        }
        attached.add(doc);

        doc.addEventListener('click', function (e) {
            var button = e.target.closest('.components-placeholder .components-button');
            var block = button && button.closest('[data-type^="acf/"]');
            if (!block || !block.id) {
                return;
            }
            if (replaying.has(button)) {
                replaying.delete(button);
                return;
            }

            var clientId = block.id.replace(/^block-/, '');
            var selected = wp.data.select('core/block-editor').getSelectedBlockClientId() === clientId;
            // Gutenberg selects the block on mousedown, so by click time it is usually selected already;
            // what matters is whether the sidebar panel has mounted yet.
            if (selected && sidebarPanelReady()) {
                return;
            }

            e.preventDefault();
            e.stopImmediatePropagation();
            if (!selected) {
                wp.data.dispatch('core/block-editor').selectBlock(clientId);
            }
            // The panel only mounts once the sidebar shows the Block tab, which otherwise happens too late.
            if (document.querySelector('.interface-complementary-area')) {
                wp.data.dispatch('core/interface').enableComplementaryArea('core/edit-post', 'edit-post/block');
            }

            var started = Date.now();
            (function wait() {
                if (sidebarPanelReady() || Date.now() - started > MAX_WAIT) {
                    replaying.add(button);
                    button.click();
                    return;
                }
                setTimeout(wait, 50);
            })();
        }, true);
    }

    // The canvas iframe is created after domReady and can be re-created, so keep checking.
    setInterval(function () {
        var frame = document.querySelector('iframe[name="editor-canvas"]');
        attach(frame && frame.contentDocument);
    }, 500);
});
