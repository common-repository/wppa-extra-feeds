<?php
/*  Copyright 2012  Alessandro Staniscia  (email : alessandro@staniscia.net)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


/**
 * DEFINE THE PAGE OPTIONS
 */

function wppaef_add_admin_info_page() {

    // Add new admin menu and save     returned page hook

    $hook_suffix = add_options_page(
            'Wppa+ Feeds', // page Title
            'Wppa+ Feeds', // menu Link
            'manage_options', //Capability
            'wppaef-html-promote-bar.php', //ID
            'wppaef_load_info_page' // funzione
    );

}

function wppaef_load_info_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include(WPPAEF_PLUGIN_DIR . '/admin/wppaef-html-promote-bar.php');
}


?>