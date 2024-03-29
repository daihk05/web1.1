<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- Start content -->
    <div class="b_page clearfix">

        <!-- left sidebar -->
        <?php
            $left = layout::get_side( 'left' , 0 , 'blog_page' );
            if( $left ){
                if( layout::get_length( 0 , 'blog_page' ) == 940 ){
                    $classes = 'fullwidth';
                }else{
                    $classes = 'fr';
                }
            }else{
                if( layout::get_length( 0 , 'blog_page' ) == 940 ){
                    $classes = 'fullwidth';
                }else{
                    $classes = 'fl';
                }
            }

            $grid = post::is_grid( 'blog_page' );
        ?>

        <div id="primary" class="w_<?php echo layout::get_length( 0 , 'blog_page' , true ); ?> <?php echo $classes; ?>">
            <div id="content" role="main">

                <div class="b w_<?php echo layout::get_length( 0 , 'blog_page' ); ?> blog_page <?php if( $grid ){ echo 'grid-view';  }else{ echo 'list-view'; } ?>">

                    <h1 class="entry-title blog_page"><?php _e( 'Blog page' , 'cosmotheme' ); ?></h1>
                    <?php
                        if( have_posts () ){
                    ?>
                            <span class="list-grid fr"><a href="javascript:void(0);" rel="blog_page" class="switch <?php if( $grid ){ echo 'swap';  } ?>">&nbsp;</a></span>
                    <?php
                        }
                    ?>
                    <p class="delimiter">&nbsp;</p>
                    <?php post::loop( 'blog_page' ); ?>
                </div>
            </div>
        </div>
        <!-- right sidebar -->
        <?php layout::get_side( 'right' , 0 , 'blog_page' ); ?>
    </div>
</div>
<?php get_footer(); ?>
