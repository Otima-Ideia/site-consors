<?php
// Template Name: Blog
?>
<?php
get_header(); ?>




<?php get_template_part('includes/entry-header'); ?>

<style>
    .blog-content{
        height: 450px;
    }
</style>

<section class="career_details">
    <div class="container">

        <div class="row">
            <!-- sidebar -->
            <?php get_sidebar('blog'); ?>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right right_side" itemscope itemtype="http://schema.org/BlogPosting">
                  <h2 style="text-align:center">Blog do Consórcio</h2>
<p style="text-align:center">Acompanhem nossas publicações e se mantenham informados sobre dicas de investimento, regras e normas para você que deseja vender o seu consorcio em andamento</p>
                <div class="single-post-content row">
                    <?php
                    global $post;
                    rewind_posts();
                    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

                    $query = new WP_Query(array(
                                'paged' => $paged,

                        'posts_per_page' => 8,
                    ));
                    function tirarAcentos($string)
                    {
                        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
                    }
                    while ($query->have_posts()) : $query->the_post();
                        $subtitle = apply_filters('plugins/wp_subtitle/get_subtitle', '', array(
                            'post_id' => get_the_ID()
                        ));

                        $acentos = array("!", "?", "=", ".", ",", "(", ")", ";");

                        if ($subtitle)
                            $postTitle = $subtitle;
                        else
                            $postTitle = get_the_title();

                        if (has_post_thumbnail())
                            $imageLink = get_the_post_thumbnail_url();
                        else
                            $imageLink = get_template_directory_uri() . "/datafiles/blog-do-consorcio/" . str_replace("ã", "a", str_replace("ç", "c", str_replace($acentos, "", tirarAcentos(str_replace(" ", "-", strtolower($postTitle)))))) . ".jpg";
                    ?>

                        <article itemscope itemtype="http://schema.org/Blog" class="col-md-6">
                            <div class="blog-content">
                                <div class="img_holder" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">


                                    <img style="margin-top:30px;" class="img-responsive" src="<?= $imageLink; ?>" title="<?php the_title();?>" alt="<?php the_title();?>" >

                                    <meta itemprop="name" content="<?php get_the_title(); ?>">
                                    <meta itemprop="height" content="300">
                                    <meta itemprop="width" content="435">
                                    <meta itemprop="url" content="<?php get_the_post_thumbnail(); ?>">
                                </div>
                                <time style="display: block;" datetime="<?php echo esc_attr(get_the_date('c')) ?>" itemprop="datePublished">
                                </time>
                                <time datetime="<?php echo esc_attr(get_the_modified_date('c')) ?>" itemprop="dateModified"></time>

                                <?php //include("includes/author.php"); 
                                ?>
                                <h3 itemprop="headline" style="font-size:13px; text-align: center;">

                                    <?php
                                    $subtitle = apply_filters('plugins/wp_subtitle/get_subtitle', '', array(
                                        'before'  => '<span class="subtitle">',
                                        'after'   => '</span>',
                                        'post_id' => get_the_ID()
                                    ));
                                    if ($subtitle) {
                                        echo $subtitle;
                                    } else {
                                        echo get_the_title();
                                    }
                                    ?>
                                </h3>
                                <?php the_excerpt(); ?>

                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="display: table;background:#ffcc00; padding-left:9px; padding-right:9px; padding-bottom:5px; padding-top:5px; margin:0 auto;">ler mais <i class="fa fa-arrow-circle-right"> </i></a>


                            </div>
                        </article>


                    <?php
                    endwhile; ?>

                </div>
                
                <div class="pagination">
                    <style>
                    .pagination {      margin-top: 55px;  text-align: center;
    display: block;}
                    .page-numbers{
                        padding-bottom: 5px;
                        padding-top: 5px;
                        padding-left: 10px;
                        padding-right: 10px;
                        background: #802990;
                        color: #ffffff;
                                        }
                                 .page-numbers:hover{
                                     color:white;
                                 }       
                             .pagination  .current{
                                 background-color: #50185b;
                             }
                    </style>
                <?php
                $big = 999999999; // need an unlikely integer
                 
                echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $query->max_num_pages
                ) );
                ?>
                <?php wordpress_pagination(); ?>
                </div>
            </div>
            
        </div>

    </div>
</section>

<!-- dados estruturados -->

<div class="hidden-meta" itemprop="author" itemscope itemtype="http://schema.org/Person">
    <meta itemprop="name" content="<?php echo esc_html(get_the_author()); ?>">
</div>
<?php if (has_post_thumbnail()) :
    $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
?>
    <div class="hidden-meta" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        <meta itemprop="url" content="<?php echo esc_url($thumb_url_array[0]); ?>">
        <meta itemprop="width" content="<?php echo esc_html($thumb_url_array[1]); ?>">
        <meta itemprop="height" content="<?php echo esc_html($thumb_url_array[2]); ?>">
    </div>

<?php endif; ?>




<?php get_footer(); ?>