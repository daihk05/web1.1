<?php
require_once("../../../wp-load.php");

$args = array(
    'post_status' => 'publish'                         
);

$news = new WP_Query( $args );

// The Loop
while ( $news->have_posts() ) {
	$news->the_post();
	$tmp_permalink = get_permalink($post->ID);
	$tmp_source = json_decode(file_get_contents('http://graph.facebook.com/?ids=' . $tmp_permalink));
	foreach ($tmp_source as $key => $value) {
		if (isset($value->shares)) {
            userLikes($post->ID, $post->post_author, $value->shares);     
			postLikes($post->ID, $value->shares);                   
		} else {
			unLikes($post->ID, $post->post_author);
		}
	}
}
wp_reset_postdata();

function postLikes( $postID, $likes) {
    $count_key = 'nr_like';
    $count = get_post_meta( $postID, $count_key, true );    

    if ($count != null) {
    	if ($count != $likes) {
    		update_post_meta($postID, $count_key, $likes);            
    	}
    } else {
    	add_post_meta($postID, $count_key, $likes);        
    }

}

function userLikes( $postID, $userID, $likes) {
    $count_key = 'nr_like';
    $user_key = 'tt_like';
    $count = get_post_meta( $postID, $count_key, true );
    $count_user = get_user_meta( $userID, $user_key, true );
    if ($count == null) {
        $count = 0;
    }
    if ($count_user != null) {
        $count_user = $count_user + $likes - $count;
        update_user_meta($userID, $user_key, $count_user);
    } else {
        add_user_meta($userID, $user_key, $likes);
    }
}

function unLikes( $postID, $userID ) {
    $count_key = 'nr_like';
    $user_key = 'tt_like';
    $count = get_post_meta( $postID, $count_key, true );
    $count_user = get_user_meta( $userID, $user_key, true );
    if ($count != null) {
    	if ($count > 0) {
            $count_user = $count_user - $count;
            update_user_meta($userID, $user_key, $count_user);
	    	update_post_meta($postID, $count_key, 0);
	    }
    } else {
    	add_post_meta($postID, $count_key, 0);
    }
}

?>