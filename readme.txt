===Posting Helpmate Robot By itluren.com===
Contributors: Rilun Chen
Donate link: https://me.alipay.com/itluren
Tags:tag,thumbnail,post
Requires at least: 2.7
Tested up to: 3.5.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Posting Helpmate Robot
== Description ==

The system will set thumbnail and tags automatically if the category ID of the post being published is contained in this list.Setting thumbnail automatically will be ignored if you set thumbnail manually or you have not already setted a thumbnail ID to the category.文章发布的时候，如果存在预设好的特色图片和TAG字段，那么系统将会自动设置特色图片和标签。如果你发布文章之前设置了特色图片，那么默认的特色图片将会被忽略！！

Related Links:
* <a href="http://www.itluren.com/posting-helpmate-robot" title="Posting Helpmate Robot">Posting Helpmate Robot</a>
* <a href="http://www.itluren.com" title="Author of Posting Helpmate Robot">Author's Website</a>

== Frequently Asked Questions ==

= How to dispose of two repeating thumbnails =

Setting thumbnail automatically will be ignored if you set thumbnail manually.

= 自己已经手动设置了特色图片会怎么样？ =

如果在文章发布前已经指定了特色图片 Posting Helpmate Robot将不会自动设置默认特色图片

== Screenshots ==

1.The option page panel of Posting Helpmate Robot 


== Installation ==

(1) unzip the plugin zip file in /wp-content/plugins

(2) Active the plugin 

== Translations ==

此插件支持多语言，欢迎您来翻译。

The plugin comes with various translations, please refer to the [WordPress Codex](http://codex.wordpress.org/Installing_WordPress_in_Your_Language "Installing WordPress in Your Language") for more information about activating the translation. If you want to help to translate the plugin to your language, please have a look at the sitemap.pot file which contains all defintions and may be used with a [gettext](http://www.gnu.org/software/gettext/) editor like [Poedit](http://www.poedit.net/) (Windows).

== A brief Markdown Example ==

Setting Example：

category IDs：1||2||3||4||5

Thumbnails IDs：11||12||13||14||15

Tags fields：Girls,Boys,Fish||Google,Apple,Facebook,Twitter||Android,iOS||Windows||me

The system will set 13 as post thumbnail ID and set 'Android,iOS' as post tag automatically if the category ID of post being published is contained in the category IDs above.

设置例子：

分类ID：1||2||3||4||5

特色图片ID：11||12||13||14||15

待选标签：Girls,Boys,Fish||Google,Apple,Facebook,Twitter||Android,iOS||Windows||me

如果，发布的文章的分类的ID是3(3被设置在分类ID里面了) 那么自动设置ID为13的图片作为文章的特色图片，自动把Android,iOS作为文章的TAG标签