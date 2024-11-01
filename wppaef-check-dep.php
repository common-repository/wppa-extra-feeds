<?php
/*  
    Copyright 2012  Alessandro Staniscia ( alessandro@staniscia.net )

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



register_activation_hook( _WPPAEF_FILE_, 'wppaef_dependent_plugin_activate' );

function wppaef_dependent_plugin_activate()
{
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

    if ( is_plugin_active( 'wp-photo-album-plus/wppa.php' ) )
    {
        require_once ( WP_PLUGIN_DIR . '/wp-photo-album-plus/wppa.php' );
    }
    else
    {
        // deactivate dependent plugin
        deactivate_plugins( _WPPAEF_FILE_);
        //   throw new Exception('Requires another plugin!');
        //  exit();
        exit ('Requires  <a href="http://wordpress.org/plugins/wp-photo-album-plus/" target="_blank">WP Photo Album Plus</a> plugin!');
    }
}