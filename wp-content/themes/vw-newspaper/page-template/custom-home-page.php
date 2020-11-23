<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<?php 
  $vw_newspaper_archive_year  = get_the_time('Y'); 
  $vw_newspaper_archive_month = get_the_time('m'); 
  $vw_newspaper_archive_day   = get_the_time('d'); 
?>

<main id="maincontent" role="main">
  <?php do_action( 'vw_newspaper_before_headline' ); ?>

  <?php if( get_theme_mod('vw_newspaper_headline_title') != ''||get_theme_mod('vw_newspaper_headline_category') != ''){ ?>
    <section class="headline">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-md-3 pl-0">
            <div class="head-title">
              <?php if( get_theme_mod('vw_newspaper_headline_title') != ''){ ?>
                <h1><?php echo esc_html(get_theme_mod('vw_newspaper_headline_title','')); ?></h1>
              <?php }?>
            </div>
          </div>
          <div class="col-lg-9 col-md-9 category-box">
            <div class="row">
              <?php 
              $vw_newspaper_catData1=  get_theme_mod('vw_newspaper_headline_category');
                if($vw_newspaper_catData1){
              $page_query = new WP_Query(array( 'category_name' => esc_html($vw_newspaper_catData1 ,'vw-newspaper')));?>
                <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                  <div class="col-lg-3 col-md-3">
                    <div class="row">
                      <div class="col-lg-4 col-md-4">
                        <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><span class="screen-reader-text"><?php the_title(); ?></span>
                      </div>
                    </div>
                  </div>
                <?php endwhile;
                wp_reset_postdata();
              } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php }?>

  <?php do_action( 'vw_newspaper_after_headline' ); ?>

  <?php if( get_theme_mod('vw_newspaper_category') != ''){ ?>
    <section id="categry">
      <div class="owl-carousel">
        <?php 
          $vw_newspaper_catData=  get_theme_mod('vw_newspaper_category');
          if($vw_newspaper_catData){
          $page_query = new WP_Query(array( 'category_name' => esc_html($vw_newspaper_catData ,'vw-newspaper')));?>
          <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
            <div class="imagebox">
              <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
              <div class="main-content-box">
                <div class="date-box">
                  <i class="fas fa-calendar-alt"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $vw_newspaper_archive_year, $vw_newspaper_archive_month, $vw_newspaper_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
                  <i class="fas fa-user"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
                  <i class="fas fa-comments"></i><span class="entry-comments"> <?php comments_number( '0 Comments', '0 Comments', '% Comments' ); ?> </span>
                </div>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h3>
              </div>
            </div>
          <?php endwhile; 
          wp_reset_postdata();
        } ?>
        <div class="clearfix"></div>
      </div>
    </section>
  <?php }?>

  <?php do_action( 'vw_newspaper_after_category_section' ); ?>

  <div class="content-vw container">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </div>
</main>

<?php get_footer(); ?>