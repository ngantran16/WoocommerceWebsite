<?php
  $vw_newspaper_search_hide_show = get_theme_mod( 'vw_newspaper_search_hide_show' );
  if ( 'Disable' == $vw_newspaper_search_hide_show ) {
   $colmd = 'col-lg-12 col-md-12';
  } else { 
   $colmd = 'col-lg-11 col-md-10 col-6';
  } 
?>
<div id="header" class="menubar">
   <div class="header-menu <?php if( get_theme_mod( 'vw_newspaper_sticky_header') != '') { ?> header-sticky"<?php } else { ?>close-sticky <?php } ?>">
    <div class="container">
      <div class="row">
        <div class="<?php echo esc_html( $colmd ); ?>">
          <?php if(has_nav_menu('primary')){ ?>
            <div class="toggle-nav mobile-menu">
              <button onclick="vw_newspaper_menu_open_nav()" class="responsivetoggle"><i class="<?php echo esc_attr(get_theme_mod('vw_newspaper_res_open_menu_icon','fas fa-bars')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Open Button','vw-newspaper'); ?></span></button>
            </div>
          <?php } ?>
          <div id="mySidenav" class="nav sidenav">
            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'vw-newspaper' ); ?>">
              <?php 
                if(has_nav_menu('primary')){
                  wp_nav_menu( array( 
                    'theme_location' => 'primary',
                    'container_class' => 'main-menu clearfix' ,
                    'menu_class' => 'clearfix',
                    'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                    'fallback_cb' => 'wp_page_menu',
                  ) ); 
                }
              ?>
              <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="vw_newspaper_menu_close_nav()"><i class="<?php echo esc_attr(get_theme_mod('vw_newspaper_res_close_menu_icon','fas fa-times')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Button','vw-newspaper'); ?></span></a>
            </nav>
          </div>
        </div>
        <?php if ( 'Disable' != $vw_newspaper_search_hide_show ) {?>
          <div class="search-box col-lg-1 col-md-2 col-6">
            <button type="button" data-toggle="modal" data-target="#myModal"><i class="fas fa-search"></i></button>
          </div>
        <?php } ?>
      </div>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-body">
            <div class="serach_inner">
              <?php get_search_form(); ?>
            </div>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
      </div>
    </div>
  </div>
</div>