<section class="mainmenu-area stricky">
<div class="container">
<p class="conteudo"><?php echo $semantica_2;?></p>
<nav class="clearfix" itemscope itemtype="https://schema.org/SiteNavigationElement">
<div class="navbar-header clearfix"><button type="button" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="fa fa-th fa-2x"></span></button></div>
<div class="nav_main_list custom-scroll-bar pull-left" id="bs-example-navbar-collapse-1">
    
    
    <?php
					wp_nav_menu(
						array(
							'menu'            => 'Menu Principal', 
							'container'       => '',
							'menu_class'      => 'nav navbar-nav',
							    'menu_id' => 'hover_slip'

							// 'items_wrap'      => '<nav class="%2$s">%3$s</nav>'
						)
					);
					?>





</div>
<div class="find-advisor pull-right">
<a href="/vender-consorcio" class="advisor" itemprop="url"><span itemprop="name" style="font-size:14px;">Venda Aqui !</span></a>
</div>
</nav>
</div>
</section>
