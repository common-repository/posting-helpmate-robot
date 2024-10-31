<?php 
/*
Plugin Name: Posting Helpmate Robot
Plugin URI: http://www.itluren.com/posting-helpmate-robot
Description: The system will set thumbnail and tags automatically if the category ID of the post being published is contained in this list.Setting thumbnail automatically will be ignored if you set thumbnail manually or you have not already setted a thumbnail ID to the category.文章发布的时候，如果存在预设好的特色图片和TAG字段，那么系统将会自动设置特色图片和标签。如果你发布文章之前设置了特色图片，那么默认的特色图片将会被忽略！！
Author: Rilun
Version: 1.0
Author URI: http://www.itluren.com/
*/
register_activation_hook(__FILE__,'itluren_posting_helpmata_activate');
add_action('admin_init', 'itluren_posting_helpmata_redirect'); 
function itluren_posting_helpmata_activate() {
add_option('posting_helpmata_activation_redirect', true);
} 
function itluren_posting_helpmata_redirect() {
    if (get_option('posting_helpmata_activation_redirect', false)) {
        delete_option('posting_helpmata_activation_redirect');
        wp_redirect(admin_url('options-general.php?page=itluren_posting_helpmate'));
    }
}
function itluren_posting_helpmate_init(){
load_plugin_textdomain('post_helpmate',false,dirname(plugin_basename( __FILE__ )).'/lang/');
}
add_action('plugins_loaded','itluren_posting_helpmate_init');
//首先来定义一些常量
define("POST_CATEGORY_ID","itluren_post_category_id");//文章分类ID
define("POST_THUMB_ID","itluren_post_thumb_id");//文章待用的特色图片
define("POST_TAG_WORD","itluren_post_tag_word");//待用的标签
//现在开始自动处理一下数据啊
function auto_set_post_data($post_id){
$categories=get_the_category($post_id);//获取文章分类
$post_cat=$categories[0]->term_id;
$post_cat=(int)$post_cat;
//分类有木有呢
if(!empty($post_cat)){
$post_thumbnail_id=get_post_thumbnail_id($post_id);//获取文章的特色图片
//接下来是获取设定的分类了
$post_category_id_array=explode("||",stripslashes(get_option(POST_CATEGORY_ID)));
//判断一下这个分类有被设置吗
if(!empty($post_category_id_array)&&in_array($post_cat,$post_category_id_array)){//相应的分类被设置了
//获取设置好的标签和特色图片ID
$post_tag_word_array=explode("||",stripslashes(get_option(POST_TAG_WORD)));
$post_thumb_id_array=explode("||",stripslashes(get_option(POST_THUMB_ID)));
//果断把那个分类ID在分类ID数组的位置抓过来啊
$post_category_position=array_search($post_cat,$post_category_id_array);
//接下来当然就是种下种子了
if(!empty($post_tag_word_array[$post_category_position])){//有预设的标签
wp_set_post_tags($post_id,$post_tag_word_array[$post_category_position],true);
}
if(!empty($post_thumb_id_array[$post_category_position])&&empty($post_thumbnail_id)){//有预设特色图片 而且没有手动设置
set_post_thumbnail($post_id,$post_thumb_id_array[$post_category_position]);
}
}
}
}
add_action('publish_post','auto_set_post_data');
//接下来是设置页面了
function itluren_post_helpmate_admin(){
?>
<style type="text/css">
#wpcontent,#wpfooter{background:#eeeeee!important;}
#itluren_updated,#itluren_show_note,#itluren_comment_filter_warp{width:70%;background:#fff;color:#333;}
#itluren_updated{height:40px;margin:20px 0 0 20px;border-left:4px #6BA82F solid;line-height:40px;text-indent:10px;}
#itluren_show_note{height:40px;margin:20px 0 0 20px;line-height:40px;-webkit-border-top-left-radius:5px;-webkit-border-top-right-radius:5px;-moz-border-radius-topleft:5px;-moz-border-radius-topright:5px;border-top-left-radius:5px;border-top-right-radius:5px;text-indent:20px;font-size:15px;background:#747474;color:#fff;}
#itluren_show_note a{color:#333;padding:5px 10px;text-decoration:none;background:#fff;margin:0 5px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px; -webkit-box-shadow:4px 2px 6px #000000;box-shadow:4px 2px 6px #000000;-moz-box-shadow:3px 2px 6px #000000;}
#itluren_comment_filter_warp{margin:0 0 0 20px;padding:20px 0 30px;-webkit-border-bottom-right-radius:5px;-webkit-border-bottom-left-radius:5px;-moz-border-radius-bottomright:5px;-moz-border-radius-bottomleft:5px;border-bottom-right-radius:5px;border-bottom-left-radius:5px;}
.itluren_comment_filter_item{width:80%;margin-left:20px;padding:20px 0;border-bottom:2px #747474 dotted;}
#itluren_comment_filter_warp .itluren_comment_filter_title{height:35px;line-height:35px;width:100%;font-size:15px;}
#itluren_comment_filter_warp .itluren_comment_filter_note{line-height:20px;width:100%;}
.itluren_comment_filter_item input,.itluren_comment_filter_item textarea{width:100%;}
.itluren_comment_filter_item textarea{min-height:100px;line-height:20px;}
#itluren_submit{padding:5px 30px;margin:10px 0 0 20px;}
.itluren_comment_filter_note b{color:#eb2d7a;font-weight:normal;}
#itluren_plugins_area{width:300px;position:fixed;top:50px;right:20px;}
#itluren_plugins_area .itluren{width:100%;margin-bottom:20px;text-indent:15px;}
#itluren_plugins_area .itluren .itluren_head{font-size:15px;-webkit-border-top-left-radius:3px;-webkit-border-top-right-radius:3px;-moz-border-radius-topleft:3px;-moz-border-radius-topright:3px;border-top-left-radius:3px;border-top-right-radius:3px;width:100%;height:35px;line-height:35px;background:#747474;color:#fff;}
#itluren_plugins_area .itluren .itluren_main{-webkit-border-bottom-right-radius:3px;-webkit-border-bottom-left-radius:3px;-moz-border-radius-bottomright:3px;-moz-border-radius-bottomleft:3px;border-bottom-right-radius:3px;border-bottom-left-radius:3px;background:#fff;color:#333;padding-top:20px;width:100%;padding-bottom:20px;}
#itluren_plugins_area .itluren .itluren_main p{height:30px;line-height:30px;color:#333;font-size:14px;margin:0px!important;font-family:'微软雅黑',sans-serif;}
#itluren_plugins_area .itluren .itluren_main p a{text-decoration:none!important;}
</style>
<?php
if(!empty($_POST['action'])){
//接下来获取参数并保存
$itluren_post_category_id=$_POST['post_category_id'];//文章分类ID
$itluren_post_thumb_id=$_POST['post_thumb_id'];//文章分类对应的特色图片
$itluren_post_tag_word=$_POST['post_tag_word'];//标签啊
update_option(POST_CATEGORY_ID,$itluren_post_category_id);
update_option(POST_THUMB_ID,$itluren_post_thumb_id);
update_option(POST_TAG_WORD,$itluren_post_tag_word);
echo '<div id="itluren_updated" onLoad="hidde_updataed();"><p><strong>';echo _e('Updataed！','post_helpmate');echo '</strong></p></div>';
}
$all_categories=get_option(POST_CATEGORY_ID);
$all_thumbnailes=get_option(POST_THUMB_ID);
$all_tags=get_option(POST_TAG_WORD);
?>
<div id="itluren_show_note"><?php echo _e('Posting Helpmate Robot is developed by','post_helpmate');?><a href="http://www.itluren.com" target="_blank">IT路人</a><?php echo _e('.','post_helpmate');?></div>
<div id="itluren_comment_filter_warp">
<form action="" method="post">
<div class="itluren_comment_filter_item" id="itluren_post_category_id">
<div class="itluren_comment_filter_title"><?php echo _e('Categories IDs Set','post_helpmate');?></div>
<div class="itluren_comment_filter_input"><textarea name="post_category_id" type="textarea"><?php echo $all_categories;?></textarea></div>
<div class="itluren_comment_filter_note"><?php echo _e('Type category IDs.The system will set thumbnail and tags automatically if the category ID of the post being published is contained in this list.<b>Note:Please ensure that two category IDs are separated by \'||\'. <br />Example:1||2||3||4||5||6</b>','post_helpmate');?></div>
</div>
<div class="itluren_comment_filter_item" id="itluren_post_thumb_id">
<div class="itluren_comment_filter_title"><?php echo _e('Default Thumbnails Set','post_helpmate');?></div>
<div class="itluren_comment_filter_input"><textarea name="post_thumb_id" type="textarea"><?php echo $all_thumbnailes;?></textarea></div>
<div class="itluren_comment_filter_note"><?php echo _e('Type thumbnails IDs.The system will set the ID whose position in this list is identical with the position of category ID selected in Categories IDs Set list above when post is being published.The default thumbnail will be ignored if you set thumbnail manually.<b>Note:Please ensure that two thumbnail IDs are separated by \'||\'. <br />Example:1||2||3||4||5||6</b>','post_helpmate');?></div>
</div>
<div class="itluren_comment_filter_item" id="itluren_post_tag_word">
<div class="itluren_comment_filter_title"><?php echo _e('Default Tags Set','post_helpmate');?></div>
<div class="itluren_comment_filter_input"><textarea name="post_tag_word" type="textarea"><?php echo $all_tags;?></textarea></div>
<div class="itluren_comment_filter_note"><?php echo _e('Type tag fields.The system will set the tag fields whose position in this list is identical with the position of category ID selected in Categories IDs Set list above when post is being published.<b>Please ensure that two fields are separated by \'||\'. <br />Example:Girls,Boys,Fish||Google,Apple,Facebook,Twitter||Android,iOS</b>','post_helpmate');?></div>
</div>
</div>
<input type="hidden" name="action" value="updataed" />
<input id="itluren_submit" type="submit" name="itluren_submit" value="<?php echo _e('Save','post_helpmate');?>" />
</form>
<div id="itluren_plugins_area">
<div class="itluren">
<div class="itluren_head"><?php echo _e('Connecting me','post_helpmate');?></div>
<div class="itluren_main">
<p><?php echo _e('Email：chenxiaoxun@gmail.com','post_helpmate');?></p>
<p><?php echo _e('Website：www.itluren.com','post_helpmate');?></p>
<p><?php echo _e('QQ：734500780','post_helpmate');?></p>
</div>
</div>
<div class="itluren">
<div class="itluren_head"><?php echo _e('Donate me','post_helpmate');?></div>
<div class="itluren_main">
<p><?php echo _e('Paypal：chenxiaoxun@gmail.com','post_helpmate');?></p>
<p><?php echo _e('Alipay：chenxiaoxun@gmail.com','post_helpmate');?></p>
</div>
</div>
<div class="itluren">
<div class="itluren_head"><?php echo _e('My Other Plugins','post_helpmate');?></div>
<div class="itluren_main">
<p><?php echo _e('<a href="http://www.itluren.com/wp-itluren-comment-filter" title="wp-itluren-comment-filter" target="_blank">wp_itluren_comment_filter</a>','post_helpmate');?></p>
</div>
</div>
</div>
<?php
}
function itluren_post_helpmate_setting() {
add_options_page('Posting Helpmate','Posting Helpmate',8,'itluren_posting_helpmate','itluren_post_helpmate_admin');
}
add_action('admin_menu', 'itluren_post_helpmate_setting');
?>