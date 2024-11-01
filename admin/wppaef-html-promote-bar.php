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
?>

<div class="wrap">

    <div id="icon-tools" class="icon32"><br> </div> <h2>Information</h2>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">

            <div id="postbox-container-1" class="postbox-container">
                <div id="side-sortables" class="meta-box-sortables">
                    <div class="postbox">
                        <div class="handlediv" title="Click to toggle"><br/><br/></div>
                        <h3 class="hndle">
                            <span><?php echo WPPAEF_NAME; ?> <small style="float: right">v<?php echo WPPAEF_VERSION; ?></small><br/></span>
                        </h3>
                        <div class="inside">
                            <div style="float: right; margin: -15px 0 10px 0"><a href="<?php echo WPPAEF_HOME_SITE_URL; ?>" target="_blank"><img src="<?php echo WPPAEF_PLUGIN_URL; ?>/img/feed-icon-28x28.png" border="0" alt="logo" /></a></div>
                            <ol>
                                <li><a class="sm_button sm_autor" href="<?php echo WPPAEF_HOME_SITE_URL; ?>" target="_blank"><?php _e('Plugin Homepage', 'ast-ogg-lang') ?></a></li>
                                <!-- <li><a class="sm_button "  href="<?php echo WPPAEF_HOME_SITE_URL; ?>" target="_blank"><?php _e('Live demo', 'ast-ogg-lang') ?></a>             </li> -->
                                <li><a class="sm_button sm_code"  href="http://wordpress.org/support/plugin/wppa-extra-feeds" target="_blank"><?php _e('Suggest a Feature', 'ast-ogg-lang') ?></a></li>
                                <li><a class="sm_button sm_bug"   href="http://wordpress.org/support/plugin/wppa-extra-feeds" target="_blank"><?php _e('Report a Bug', 'ast-ogg-lang') ?></a>          </li>
                                <li><a class="sm_button sm_star"  href="http://wordpress.org/support/view/plugin-reviews/wppa-extra-feeds" target="_blank"><?php _e('Rate the plugin on WordPress.org', 'ast-ogg-lang') ?></a> </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <p>
               Just now you have the last 10 photos of site, you can find it <?php echo do_shortcode('[wppaef text_url="on this url"]'); ?> but if you can add the feed on your forum on your page with this shortcode:
            </p>
            <code>[wppaef]</code>
            <p>
                If you want to control the link, you can add these attributes on shortcode
            </p>
            <table>
                <tr><td><b>Options</b></td><td><b>Description</b></td></tr>
                <tr><td><code>max-num</code></td><td>Max number of feed(default is 10)</td></tr>
                <tr><td><code>icon_url</code></td><td>Url of one custom icon</td></tr>
                <tr><td><code>text_url</code></td><td>Text to show in to the url</td></tr>
                <tr><td><code>album_id</code></td><td>Filter for album id (you can add multiple id separated by comma)</td></tr>
            </table>
            <p>
                for example
            </p>
            <ol>
                <li><code>[wppaef max-num=5]</code> show only 5 photos (<?php echo do_shortcode('[wppaef max-num=5]'); ?>)</li>
                <li><code>[wppaef max-num=5 album-id=2,3]</code> show only the last 5 photos of album id 2 and 3 (<?php echo do_shortcode('[wppaef max-num=5 album-id=2,3 ]'); ?>)</li>
                <li><code>[wppaef max-num=5 album-id=2,3 text_url="Last 5 photo of album 2 and 3"]</code> show only the last 5 photos of album id 2 and 3 (<?php echo do_shortcode('[wppaef max-num=5 album-id=2,3 text_url="Last 5 photo of album 2 and 3"]'); ?>)</li>
            </ol>
            <div class="clear"></div>
        </div>
    </div>
</div>



