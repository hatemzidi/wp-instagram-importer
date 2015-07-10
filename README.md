# WP-Instagram-Importer
Imports Instagram photos as posts to your WordPress site


## Description

WP Instagram importer is a simple plugin that retrieve an instagram account's photos as posts into wordpress.
The plugin will run periodically to check the last photos from the account.


## Features

* Specifying Instagram account via oAuth.
* Set the category and the user for the new created posts.
* Can make the image as a featured image.
* Can set content of each new post
* Set the new post format as 'Image'


## Installation

1. Upload the 'wp-instagram-importer' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Update the plugin's settings.

## The plugin doesn't work, what do I do? 

euh ... well! it's still buggy, so bare with me :)

## License

The WP Instagram Importer is licensed under the GPL v2 or later.

> This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 2, as published by the Free Software Foundation.

> This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

> You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA

A copy of the license is included in the root of the plugin’s directory. The file is named `LICENSE`.

# Credits
This plugin was inspired from the [work](http://mlitzinger.com/articles/instagram-to-wordpress-posts/) of [Matt Litzinger](http://mlitzinger.com/).

It's also based on the [WordPress Plugin Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate) by [Devin Vinson](http://devinvinson.com/) and example from [now-hiring](https://github.com/slushman/now-hiring).

## Changelog

#### 0.1

* first release

## todo 
- ~~[admin] add settings page~~
- [admin] separate into tabs (intagram | settings)
- [admin] use instagram oAuth or authorized app
- [admin] tags of created posts 
- [admin] post status ?
- ~~[admin] set featured ?~~
- [admin] set format ?
- [admin] set default content for the new post
- [admin][dev] add shortcodes for content : link, image, date, caption...
- [dev] refactor to : https://github.com/DevinVinson/WordPress-Plugin-Boilerplate
- [dev] 'continuous' refactor
- [web] make landing website
- [prod] add plugin to wordpress repo, update what's needed for that