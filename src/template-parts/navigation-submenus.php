<?php
$locations = get_nav_menu_locations();
$navigation_menu = wp_get_nav_menu_object($locations['navigation-menu']);
$navigation_menu_items = wp_get_nav_menu_items($navigation_menu->term_id, array('order' => 'DESC'));

// Function to recursively get submenus
function get_submenus($menu_items, $parent_id) {
    $submenus = array();

    foreach ($menu_items as $menu_item) {
        if ($menu_item->menu_item_parent == $parent_id) {
            $submenu = new stdClass();
            $submenu->item = $menu_item;
            $submenu->children = get_submenus($menu_items, $menu_item->ID);
            $submenus[] = $submenu;
        }
    }

    return $submenus;
}

// Get submenus
$submenus = get_submenus($navigation_menu_items, 0);

// Function to render submenus recursively
function render_submenu($submenu, $depth=0) {
    echo '<div class="navigation-submenu">';
		if ( $depth == 0 ) {
			echo '<h3 class="submenu-title"><a href="' . $submenu->item->url . '">' . $submenu->item->title . '</a></h3>';
		}
		else if ( $depth == 1 ) {
			echo '<h3><a href="' . $submenu->item->url . '">' . $submenu->item->title . '</a></h3>';
		}
		else {
			echo '<a href="' . $submenu->item->url . '">' . $submenu->item->title . '</a>';
		}
    if (!empty($submenu->children)) {
        echo '<ul>';
        foreach ($submenu->children as $child_submenu) {
            echo '<li>';
            render_submenu($child_submenu, $depth+1);
            echo '</li>';
        }
        echo '</ul>';
    }
    echo '</div>';
}

// Render submenus
echo "<div id='navigation-submenu-container'>";
foreach ($submenus as $submenu) {
    render_submenu($submenu);
}
echo "</div>";
?>
