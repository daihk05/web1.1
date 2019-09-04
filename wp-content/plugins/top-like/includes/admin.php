<?php
class tk_widget extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {
		$widget_ops = array(
			'classname'		=> 'toplike_widget',
			'description'	=> __( 'Display top like facebook widget.', 'tk' )
		);
		parent::__construct( 'tk_widget', __( 'Top Like', 'tk' ), $widget_ops);
	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		$title 			= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$limit 			= (int)( $instance['limit'] );
		$offset 	    = (int)( $instance['offset'] );	
		$page_rm_m		= strip_tags( $instance['page_rm_m'] );
		$page_rm_a		= strip_tags( $instance['page_rm_a'] );

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		global $wpdb;
		$querystr = "SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta WHERE $wpdb->usermeta.meta_key = 'tt_like' ORDER BY $wpdb->usermeta.meta_value DESC";
		 
		$results = $wpdb->get_results( $querystr, ARRAY_N );

		$tmp_tkid = array();
		$i = 0;
		$tmp;
		foreach ($results as $key => $value) {
			$tmp_tkid[$i] = $value[0];
			$i++;
		}

		?>
			
		<div <?php echo( ! empty( $cssID ) ? 'id="' . $cssID . '"' : '' ); ?> class="tk-block">
			<?php 
				$tmp_url = get_home_url();
				for ($i=0; $i < count($tmp_tkid); $i++) { 
					$nick_name = get_user_meta( $tmp_tkid[$i], 'nickname', true );
					if ($nick_name == null) {
						$user_info = get_userdata($tmp_tkid[$i]);
						$nick_name = $user_info->user_login;
					}
					$count_user = get_user_meta( $tmp_tkid[$i], 'tt_like', true );
					if ($i < $limit) {
			?>
						<li class="tk-clearfix clearfix cl">
							<?php echo get_avatar( $tmp_tkid[$i], 32 ); ?>
							<h3><a href="<?php echo $tmp_url . "?author=" . $tmp_tkid[$i];?>"><?php echo $nick_name;?></a></h3>
							<p class="tt_like"><?php echo $count_user;?></p>			
						</li>
			<?php 
					} else {
						break;
					}
				}
			?>
			<p><a href="<?php echo $page_rm_a;?>"><?php _e( 'Xem thêm', 'tk' ); ?><span>
		</div>

		<?php
		echo $after_widget;
	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {

		$instance 					= $old_instance;
		$instance['title'] 			= strip_tags( $new_instance['title'] );		
		$instance['limit'] 			= (int)( $new_instance['limit'] );
		$instance['offset'] 		= (int)( $new_instance['offset'] );	
		$instance['page_rm_m'] 		= strip_tags( $new_instance['page_rm_m'] );
		$instance['page_rm_a'] 		= strip_tags( $new_instance['page_rm_a'] );		

		return $instance;

	}

	/**
	 * Widget setting
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' 		=> '',
			'limit' 		=> 8,
			'offset' 		=> 100,
			'page_rm_m'		=> '',
			'page_rm_a'		=> ''
		);

		$instance 		= wp_parse_args( (array)$instance, $defaults );
		$title 			= strip_tags( $instance['title'] );
		$limit 			= (int)( $instance['limit'] );
		$offset 		= (int)( $instance['offset'] );
		$page_rm_m		= strip_tags( $instance['page_rm_m'] );
		$page_rm_a		= strip_tags( $instance['page_rm_a'] );

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'tk' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Limit:', 'tk' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo $limit; ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php _e( 'Offset (the number of user to display):', 'tk' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo $offset; ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'page_rm_m' ) ); ?>"><?php _e( 'Page readmore month: (short code: [toplike foo=\'month\']', 'tk' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'page_rm_m' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'page_rm_m' ) ); ?>" type="text" value="<?php echo $page_rm_m; ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'page_rm_a' ) ); ?>"><?php _e( 'Page readmore all: (short code: [toplike foo=\'all\']', 'tk' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'page_rm_a' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'page_rm_a' ) ); ?>" type="text" value="<?php echo $page_rm_a; ?>"/>
		</p>
	<?php
	}

}

/**
 * Register widget.
 *
 * @since 0.1
 */
function tk_register_widget() {
	register_widget( 'tk_widget' );
}
add_action( 'widgets_init', 'tk_register_widget' );

function toplike_func( $atts ) {    
	$tmp_rt = $atts['foo'];
	$tmp_out = '';
	$tmp_tk = new tk_widget();
	$tmp_st = $tmp_tk->get_settings();
	foreach ($tmp_st as $key => $value) {
		$tmp_offset = (int) $value['offset'];
	}

	if ($tmp_rt == 'all') {
		$tmp_out .= '<h3>Tất cả</h3>';

		global $wpdb;
		$querystr = "SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta WHERE $wpdb->usermeta.meta_key = 'tt_like' ORDER BY $wpdb->usermeta.meta_value DESC";
		 
		$results = $wpdb->get_results( $querystr, ARRAY_N );

		$tmp_tkid = array();
		$i = 0;
		$tmp;
		foreach ($results as $key => $value) {
			$tmp_tkid[$i] = $value[0];
			$i++;
		}

		$tmp_out .= '<div class=\'tk-block\'>';
		$tmp_url = get_home_url();
		for ($i=0; $i < count($tmp_tkid); $i++) { 
			$nick_name = get_user_meta( $tmp_tkid[$i], 'nickname', true );
			if ($nick_name == null) {
				$user_info = get_userdata($tmp_tkid[$i]);
				$nick_name = $user_info->user_login;
			}
			$count_user = get_user_meta( $tmp_tkid[$i], 'tt_like', true );
			if ($i < $tmp_offset) {
				$tmp_out .= '<li class=\'tk-clearfix clearfix cl\'>';
				$tmp_out .= get_avatar( $tmp_tkid[$i], 32 );
				$tmp_out .= '<h3><a href=\'' . $tmp_url . '?author=' . $tmp_tkid[$i] . '\' >' . $nick_name . '</a></h3>';
				$tmp_out .= '<p class=\'tt_like\'>' . $count_user . '</p>';		
				$tmp_out .= '</li>';
			}
		}

		$tmp_out .= '</div>';
	}

    return $tmp_out;
}
add_shortcode('toplike', 'toplike_func');
?>