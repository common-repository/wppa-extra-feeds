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


include_once('class-wppaef-feed.php');
include_once('class-wppaef-feed-formatter.php');

function wppaef_add_feeds_to_site(){
    add_feed(FEED_NAME_OF_WPPA, 'wppaef_do_add_feeds_to_site');
}

function wppaef_do_add_feeds_to_site(){
    global $_GET;
    $album = null;
    $max=10;


    if (isset ($_GET['max-feed'])){
       $max=intval($_GET['max-feed']);
    }else{
       $max=10;
    }

    if (isset ($_GET['album-id']) && !empty($_GET['album-id'])){
        $albumsId = explode(",",$_GET['album-id']);
        $albumValidId=array();
        foreach($albumsId as $idAlbum){
              array_push($albumValidId,intval($idAlbum));
        }
        if (count($albumValidId) > 0 ){
           $album = implode(",", $albumsId);
        }else{
           $album = null;
        }
    }



    $formatter=new Wppaef_Feed_Formatter(FEED_NAME_OF_WPPA);

    foreach(wppaef_get_all_last_photo($max, $album) as $feed){
        $formatter->add($feed);
    }

    $formatter->show();
}


function wppaef_get_all_last_photo($max = 10, $album = null){

    global $wpdb;
    global $wppa_opt;

    $extra_where="";

    if ($album != null) {
        $extra_where = " `album` in ( " . $album . " ) AND ";
    }

    $query = "SELECT * FROM `" . WPPA_PHOTOS . "` WHERE ".$extra_where." `status` <> 'pending' ORDER BY `timestamp` DESC LIMIT " . $max;

    $thumbs = $wpdb->get_results($query, ARRAY_A);

    $maxw = $wppa_opt['wppa_topten_size'];
    $feeds = array();

    if ($thumbs) {
        foreach ($thumbs as $image) {

            global $thumb;
            $thumb = $image;

            if ($image) {
                $feed = new Wppaef_Feed();
                //$feed['location'] = $image['location'];
                $feed->timestamp= $image['timestamp'];
                $feed->owner = $image['owner'];
                $feed->owner_url=   wppaef_get_user_profile_link($feed->owner);
                $feed->description = stripslashes($image['description']);
                $feed->album = wppa_get_album_name($image['album']);


                $no_album = !$album;
                if ($no_album) {
                    $tit = 'View the top rated photos';
                } else {
                    $tit = esc_attr(wppa_qtrans(stripslashes($image['description'])));
                }

                $link = wppa_get_imglnk_a('lasten', $image['id'], '', $tit, '', $no_album, $album);
                $file = wppa_get_thumb_path($image['id']);

                $imgstyle_a = wppa_get_imgstyle_a($file, $maxw, 'center', 'ttthumb');
                $width = $imgstyle_a['width'];
                $height = $imgstyle_a['height'];

                $usethumb = wppa_use_thumb_file($image['id'], $width, $height) ? '/thumbs' : '';
                $imgurl = WPPA_UPLOAD_URL . $usethumb . '/' . $image['id'] . '.' . $image['ext'];


                if ($link) {
                    if ($link['is_url']) { // Is a href

                        $feed->img_url = $link['url'];
                        $feed->img_url_taget = $link['target'];
                        $feed->img_title = esc_attr(stripslashes($link['title']));
                        $feed->img_src = $imgurl;
                        $feed->prefered_width = $width;
                        $feed->prefered_height = $height;
                        $feed->img_alternative_text = esc_attr(wppa_qtrans($image['name']));
                    } elseif ($link['is_lightbox']) {
                        $feed->img_url = $link['url'];
                        $feed->img_url_taget = $link['target'];
                        $feed->img_title = wppa_get_lbtitle('thumb', $image['id']);
                        $feed->img_src = $imgurl;
                        $feed->prefered_width = $width;
                        $feed->prefered_height = $height;
                        $feed->img_alternative_text = esc_attr(wppa_qtrans($image['name']));
                    } else { // Is an onclick unit
                        $feed->img_url = $imgurl;
                        $feed->img_url_taget = "";
                        $feed->img_title = esc_attr(stripslashes($link['title']));
                        $feed->img_src = $imgurl;
                        $feed->prefered_width = $width;
                        $feed->prefered_height = $height;
                        $feed->img_alternative_text = esc_attr(wppa_qtrans($image['name']));
                    }
                } else {
                    $feed->img_url = $imgurl;
                    $feed->img_url_taget = "";
                    $feed->img_title = "";
                    $feed->img_src = $imgurl;
                    $feed->prefered_width = $width;
                    $feed->prefered_height = $height;
                    $feed->img_alternative_text = esc_attr(wppa_qtrans($image['name']));
                }
               // $feed['rating_html'] = wppa_get_rating_by_id($image['id']);
               // $feed['rating_count_html'] = '(' . wppa_get_rating_count_by_id($image['id']) . ')';
            }

            array_push($feeds,$feed);

        }

    }
    return $feeds;
}



function wppaef_get_user_profile_link($user_name){
    $user = get_user_by('login', $user_name);
    if (function_exists('bp_core_get_userurl')) {
        return bp_core_get_userurl($user->ID);
    } else {
        $user_info = get_userdata($user->ID);
        return $user_info->user_login;
    }
}

?>