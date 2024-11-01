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



function wppaef_feed_link_shortcode_to_site($atts){

    extract( shortcode_atts( array(
        'max_feed' => 10,
        'icon_url' => WPPAEF_PLUGIN_URL. 'img/feed-icon-14x14.png',
        'text_url' =>"",
        'album_id' => null
    ), $atts ) );

    $url_param='feed=' . FEED_NAME_OF_WPPA.'&max-feed='.$max_feed.'&album-id='.$album_id;
    $url=get_site_url() . '/?'.$url_param;

    return "<a href=\"$url\" target='_blank'><img src=\"$icon_url\" alt=\"[Photo Feeds] \">$text_url</a>";

}