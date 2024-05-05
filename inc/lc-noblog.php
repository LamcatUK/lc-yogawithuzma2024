<?php

function remove_menus()
{
    remove_menu_page('edit.php'); // Hides the 'Posts' menu
}
add_action('admin_menu', 'remove_menus');

function remove_post_capabilities()
{
    $role = get_role('editor'); // or another role as necessary
    $role->remove_cap('edit_posts');
    $role->remove_cap('publish_posts');
    $role->remove_cap('delete_posts');
}
add_action('init', 'remove_post_capabilities');
