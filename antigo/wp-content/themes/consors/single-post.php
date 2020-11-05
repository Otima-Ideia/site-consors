<?php get_header(); ?>




<?php  get_template_part('includes/entry-header');?>

<section class="career_details">
    <div class="container">
      
        <div class="row">
             <!-- sidebar -->
            <?php get_sidebar('blog'); ?>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right right_side" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="single-post-content">
                    <article>
                        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                       
                        <div itemprop="articleBody">
                             <?php
                               $subtitle = apply_filters( 'plugins/wp_subtitle/get_subtitle', '', array(
    'before'  => '<h1>',
    'after'   => '</h1>',
    'post_id' => get_the_ID()
) );
if($subtitle  ){
    echo $subtitle;
}
                               ?>
                             <?php the_content(); ?>
                        </div>
                        <!-- date -->
                        
                        <time datetime="<?php echo esc_attr(get_the_modified_date( 'c' )) ?>"
                            itemprop="dateModified"></time>
    
    
    
                        <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                    </article>
                </div>
            
                <div class="row">

                 

                    <!-- next post -->
                    
                    

                    <?php
                        $next_post = get_next_post();
                        if (!empty( $next_post )): ?>
                   
                   <div class="quote-box dt">
<div class="quote-content dtc">
<p style="margin-bottom: 3px;">Veja também: <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"
                                title="<?php echo esc_attr( $next_post->post_title ); ?>">
                               
                              <?php echo esc_attr( $next_post->post_title ); ?>

                               
                            </a>
                            
                            </p>
</div>
</div>
                   
                   

                    <?php endif; ?>
                </div>
   
            </div>
          
           
        </div>
    </div>
   </div>
    <!-- dados estruturados -->

    <div class="hidden-meta" itemprop="author" itemscope itemtype="http://schema.org/Person">
        <meta itemprop="name" content="<?php echo esc_html(get_the_author()); ?>">
    </div>
    <?php if ( has_post_thumbnail() ) :
		$thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		?>
    <div class="hidden-meta" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        <meta itemprop="url" content="<?php echo esc_url($thumb_url_array[0]); ?>">
        <meta itemprop="width" content="<?php echo esc_html($thumb_url_array[1]); ?>">
        <meta itemprop="height" content="<?php echo esc_html($thumb_url_array[2]); ?>">
    </div>

    <?php endif; ?>

   




<?php get_footer(); ?>