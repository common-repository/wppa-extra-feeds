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

if (!class_exists("Wppaef_Feed_Formatter")) :

    class Wppaef_Feed_Formatter
    {
        private $site_url;
        private $site_favicon;
        private $feed_link;
        private $feeds=array();


        function __construct($feed_name){
            $this->site_url= get_site_url();
            $this->site_favicon=  get_stylesheet_directory_uri()."/favicon.png";
            $this->feed_link=get_site_url() . '/?feed=' . $feed_name;
        }

        public function add(Wppaef_Feed $feed){
            array_push($this->feeds, $feed);
        }

        public function parse(){
            return $this->parse_all();
        }


        public function show()
        {
            header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);
            header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
            echo  $this->parse();
        }

        private function parse_single_content_description($img_owner, $img_desc, $img_album, $img_src, $img_width, $img_height, $img_alt_text)
        {
            $out  = '<img src="' . $img_src . '" width="' . $img_width . '" height="' . $img_height . '" alt="' . $img_alt_text . '"><br>';
            $out .= "<b>Author: </b>" . wppaef_get_user_profile_link($img_owner) . "<br>";

            if ($img_desc != null) {
                $out .= $img_desc . "<br>";
            }

            $out .= "<b>Archived: </b>" . $img_album;
            return $out;
        }

        private function parse_single_feed(Wppaef_Feed $feed)
        {

            if ($feed->img_title == "") {
                $title = "Photo of " . $feed->owner;
            } else {
                $title = $feed->img_title;
            }

            $content= $this->parse_single_content_description(
                $feed->owner,
                $feed->img_description,
                $feed->album,
                $feed->img_src,
                $feed->prefered_width,
                $feed->prefered_height,
                $feed->img_alternative_text);

            $outPage=
                '<entry>
                    <title>' . $title . '</title>
                    <link rel="alternate" type="text/html" href="' . $feed->img_url . '"/>
                    <id>'.$feed->img_src.'</id>
                    <published>'.self::formatDate(trim($feed->timestamp)).'</published>
                    <updated>'.self::formatDate(trim($feed->timestamp)).'</updated>
                    <content type="html">
                        ' . htmlentities($content) . '
                    </content>
                    <author>
                        <name>'. $feed->owner . '</name>
                        <uri>' . $feed->owner_url . '</uri>
                    </author><link rel="enclosure" type="image/jpeg" href="' . $feed->img_src . '"/>
                </entry>';

            return $outPage;
        }

        private function parse_all()
        {
            $allEntry="";

            foreach ($this->feeds as $feed) {
                $allEntry .= $this->parse_single_feed($feed);
            }

            $outPage =
            '<?xml version = "1.0" encoding = "utf-8" standalone = "yes"?>
            <feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
                <id>'.$this->feed_link.'</id>
                <title>Uploads from everyone</title>
                <link rel="self" href="' . $this->feed_link . '"/>
                <link rel="alternate" type="text/html" href="' . $this->site_url . '"/>
                <icon>' . $this->site_favicon . '</icon>
                <subtitle></subtitle>
                <updated>' . self::formatDate(trim(time())) . '</updated>
                <generator uri="' . $this->site_url . '">' . $this->site_url . '</generator>
                '.$allEntry.'
            </feed>';

            return $outPage;
        }



        private static function formatDate($data_of_sql){
             return date('Y-m-d\TH:i:sP',$data_of_sql);
        }

    }

endif;