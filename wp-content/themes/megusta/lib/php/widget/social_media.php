<?php
    class widget_social_media extends WP_Widget{
        function widget_social_media() {
            $options = array( 'classname' => 'social_media', 'description' => __('Display list of social media icons' , 'cosmotheme' ) );
            parent::WP_Widget( false , _TN_ . ' : ' . __( 'Social Media' , 'cosmotheme' )  , $options );

        }

        function form($instance) {
            if( isset($instance['title']) ){
                $title = esc_attr($instance['title']);
            }else{
                $title = __( 'Social Media' , 'cosmotheme' );
            }

        	if( isset( $instance['twitter_id'] ) ){
                $twitter_id = $instance['twitter_id'] ;
            }else{
                $twitter_id = options::get_value( 'social' , 'twitter' );
            }
            
        	if( isset( $instance['fb_id'] ) ){
                $fb_id = $instance['fb_id'] ;
            }else{
                $fb_id = options::get_value( 'social' , 'facebook' );
            }
            
        	if( isset( $instance['linkedin_url'] ) ){
                $linkedin_url = $instance['linkedin_url'] ;
            }else{
                $linkedin_url = options::get_value( 'social' , 'linkedin' );;
            }

            if( isset( $instance['flickr_id'] ) ){
                $flickr_id = $instance['flickr_id'] ;
            }else{
                $flickr_id = options::get_value( 'social' , 'flickr' );;
            }

        	if( isset( $instance['contact_email'] ) ){
                $contact_email = $instance['contact_email'] ;
            }else{
                $contact_email = options::get_value( 'social' , 'email' );;
            }
            
        	if( isset($instance['show_rss']) ){
                $show_rss = esc_attr( $instance['show_rss'] );
            }else{
                $show_rss = 0;
            }
            
        ?>
        <p>
          <label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e( 'Title' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'twitter_id' ); ?>"><?php _e( 'Facebook ID' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'fb_id' ); ?>" name="<?php echo $this->get_field_name( 'fb_id' ); ?>" type="text" value="<?php echo $fb_id; ?>" />
        </p>
        
        <p>
          <label for="<?php echo $this->get_field_id( 'fb_id' ); ?>"><?php _e( 'Twitter ID' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'twitter_id' ); ?>" name="<?php echo $this->get_field_name( 'twitter_id' ); ?>" type="text" value="<?php echo $twitter_id; ?>" />
        </p>
        
        <p>
          <label for="<?php echo $this->get_field_id( 'linkedin_url' ); ?>"><?php _e( 'LinkedIn Public Profile URL' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'linkedin_url' ); ?>" name="<?php echo $this->get_field_name( 'linkedin_url' ); ?>" type="text" value="<?php echo $linkedin_url; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e( 'Flickr ID (<a target="_blank" href="http://www.idgettr.com">idGettr</a>)' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" type="text" value="<?php echo $flickr_id; ?>" />
        </p>
        
        <p>
          <label for="<?php echo $this->get_field_id( 'contact_email' ); ?>"><?php _e( 'Contact email' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'contact_email' ); ?>" name="<?php echo $this->get_field_name( 'contact_email' ); ?>" type="text" value="<?php echo $contact_email; ?>" />
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'show_rss' ); ?>"><?php _e( 'Show RSS' , 'cosmotheme' ); ?>:</label>
        	<input type="checkbox" id="<?php echo $this->get_field_id( 'show_rss' ); ?>"  <?php checked( $show_rss , true ); ?>  name="<?php echo $this->get_field_name( 'show_rss' ); ?>"  value="1" />
        </p>
        
        <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title']          = strip_tags( $new_instance['title'] );
            $instance['twitter_id']     = strip_tags( $new_instance['twitter_id'] );
            $instance['fb_id'] 			= strip_tags( $new_instance['fb_id'] );
            $instance['linkedin_url']   = strip_tags( $new_instance['linkedin_url'] );
            $instance['flickr_id']      = strip_tags( $new_instance['flickr_id'] );
            $instance['contact_email']  = strip_tags( $new_instance['contact_email'] );
            $instance['show_rss']    	= strip_tags( $new_instance['show_rss'] );
            return $instance;
        }

        function widget($args, $instance) {

            extract( $args );

            /* widget title */
            if( !empty( $instance['title'] ) ){
               $title = apply_filters('widget_title', $instance['title']);
            }else{
               $title = '';
            }

            /* Twitter ID */
            if( isset( $instance['twitter_id'] ) ){
                $twitter_id = $instance['twitter_id'];
            }

        	/* FB ID */
            if( isset( $instance['fb_id'] ) ){
                $fb_id = $instance['fb_id'];
            }
            
        	/* linkedin_url */
            if( isset( $instance['linkedin_url'] ) ){
                $linkedin_url = $instance['linkedin_url'];
            }

            if( isset( $instance['flickr_id'] ) ){
                $flickr_id = $instance['flickr_id'];
            }
            
        	/* contact_email */
            if( isset( $instance['contact_email'] ) ){
                $contact_email = $instance['contact_email'];
            }
            /*RSS*/
            if( isset($instance['show_rss']) && $instance['show_rss'] == 1){ 
                $show_rss = $instance['show_rss']; 
            }else{
                $show_rss = 0; 
            }
                
            echo $before_widget;

            if ( strlen( $title ) ) {
                    echo $before_title . $title . $after_title;
            }
?>
			<div class="social-media">
				<ul>
					<?php if(isset($fb_id) && strlen($fb_id)) {?>
					<li class="fb"><a href="http://facebook.com/people/@/<?php echo $fb_id; ?>" class="hover" >Facebook</a> </li>
					<?php } ?>
					<?php if(isset($twitter_id) && strlen($twitter_id)) {?>
					<li class="twitter"><a href="http://twitter.com/#!/<?php echo $twitter_id; ?>" class="hover" >Twitter</a> </li>
					<?php } ?>
					<?php if(isset($linkedin_url) && strlen($linkedin_url ) ) {?>
					<li class="linked"><a href="<?php echo $linkedin_url; ?>" class="hover" >Linked In</a> </li>
					<?php } ?>
                    <?php if(isset( $flickr_id ) && strlen( $flickr_id ) ) {?>
					<li class="flickr"><a href="http://www.flickr.com/photos/<?php echo $flickr_id; ?>/" class="hover" >Flickr</a> </li>
					<?php } ?>
					<?php if(isset($contact_email) && strlen($contact_email)) {?>
					<li class="email"><a href="mailto:<?php echo $contact_email; ?>" class="hover" >Email</a> </li>
					<?php } ?>
					<?php if(isset($show_rss) && $show_rss == 1) {?>
					<li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" class="hover" >RSS</a> </li>
					<?php } ?>
				</ul>
			</div>	
<?php 
      
            echo $after_widget;
        }
    }
?>