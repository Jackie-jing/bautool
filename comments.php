<?php
    if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('请不要打开评论文件，谢谢！');
?>
<!– Comment’s List –>
<div class="row info-content comment-content">
    <h2 style="margin-top:-20px;margin-bottem:20px">评论</h2>
    <ul class="commentlist">
	        <?php
	    if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
	        // if there's a password
	        // and it doesn't match the cookie
	    ?>
	    <li class="decmt-box">
	        <p><a href="#addcomment">请输入密码再查看评论内容.</a></p>
	    </li>
	    <?php
	        } else if ( !comments_open() ) {
	    ?>
	    <li class="decmt-box">
	        <p><a href="#addcomment">评论功能已关闭!</a></p>
	    </li>
	    <?php
	        } else if ( !have_comments() ) {
	    ?>
	    <li class="decmt-box">
	        <p><a href="#addcomment">还没有任何评论，你来说两句吧</a></p>
	    </li>
	    <?php
	        } else {
	            wp_list_comments('type=comment&callback=aurelius_comment');
	        }
	    ?>
    </ul>
    <!– Comment Form –>
   <?php
if ( !comments_open() ) :
// If registration required and not logged in.
elseif ( get_option('comment_registration') && !is_user_logged_in() ) :
?>
<p>你必须 <a href="<?php echo wp_login_url( get_permalink() ); ?>">登录</a> 才能发表评论.</p>
<?php else  : ?>
<!-- Comment Form -->
<form id="commentform" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
    <h2>发表评论</h2>
    <ul>
        <?php if ( !is_user_logged_in() ) : ?>
        <div style="width:50%" class="row">
        <li class="clearfix">
            <label for="name">昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称</label>
            <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="23" tabindex="1" />
        </li>
        <li class="clearfix">
            <label for="email">电子邮件</label>
            <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="23" tabindex="2" />
        </li>
        <li class="clearfix">
            <label for="email">网站地址</label>
            <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="23" tabindex="3" />
        </li>
        </div>
        <?php else : ?>
        <li class="clearfix">您已登录:<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出登录">退出 &raquo;</a></li>
        <?php endif; ?>
        <li class="clearfix row">
            <textarea id="content-box" name="comment" tabindex="4" placeholder="请输入评论"></textarea>

        </li>
        <li class="clearfix">
            <!-- Add Comment Button -->
            <a href="javascript:void(0);" onClick="Javascript:document.forms['commentform'].submit()" class="comment-submit searchsubmit" style="color:#fff;">发表评论</a> </li>
    </ul>
    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; ?>

</div>