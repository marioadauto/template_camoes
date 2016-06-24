<?php defined( '_JEXEC' ) or die;
	  include_once JPATH_THEMES.'/'.$this->template.'/logic.php';
	  $sitename = $app->get('sitename');
	  $itemid   = $app->input->getCmd('Itemid', '');
	  $copyright = $app->get('copyright');
	  if ($this->params->get('logoFile'))
	  {
		  $logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
	  }
	  elseif ($this->params->get('sitetitle'))
	  {
		  $logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
	  }
	  else
	  {
		  $logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
	  }
	  $menu = &JSite::getMenu();
	  $isHome = $menu->getActive() == $menu->getDefault();
	  $subPageClass = $isHome ? "" : "subpage";
      $hasLeftCol = $this->countModules('aside-left');
      $hasRightCol = $this->countModules('aside-right');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
	<jdoc:include type="head" />

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700;Raleway:100,200,300,400' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $tpath; ?>/images/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $tpath; ?>/images/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $tpath; ?>/images/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $tpath; ?>/images/apple-touch-icon-144x144.png">
	<link rel="icon" type="image/png" href="<?php echo $tpath; ?>/images/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo $tpath; ?>/images/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo $tpath; ?>/images/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo $tpath; ?>/images/manifest.json">
	<link rel="mask-icon" href="<?php echo $tpath; ?>/images/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="<?php echo $tpath; ?>/images/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!-- Le HTML5 shim and media query for IE8 support -->
	<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<script type="text/javascript" src="<?php echo $tpath; ?>/js/respond.min.js"></script>
	<![endif]-->
</head>  
<body role="document">

	<?php if ($this->countModules('menu-mobile')) : ?>
		<jdoc:include type="modules" name="menu-mobile" />     
	<?php endif; ?>	
	<div class="wrapper">
	<!--Header / Cabeçalho --> 
		<header role="banner">
		<!--Menu topo--> 
		<?php if ($this->countModules('topbar')) : ?>
		<div class="header-top hidden-xs" id="top-bar">
			<div class="container" >
				  <jdoc:include type="modules" name="topbar" />
			</div>
		</div>
	<?php endif; ?>
		<!--Menu com Logo e nav-->
		<div class="header-bottom  <?php echo $subPageClass; ?>">
			<div class="container">
				<div class="row">
					<div class="navbar-header col-xs-7 <?php echo $isHome ? "col-sm-4 col-md-3" : "col-xs-7 col-sm-2" ?> ">
						<a href="#menu-mobile" onclick="Abre();" class="hidden-sm hidden-md hidden-lg" id="callmenu">
							<img class="hamburger" src="<?php echo $tpath; ?>/images/hamburger.svg" alt="Menu-mobile">
						</a>
						<a class="navbar-logo" title="<?php echo $this->baseurl; ?>/" href="<?php echo $this->baseurl; ?>/">	
							<?php echo $logo; ?>
						</a>
					</div>
					<?php  if ($isHome) { ?>
					<jdoc:include type="modules" name="header" />
                    <?php } ?>
					<div class="col-xs-5 <?php echo $isHome ? "col-sm-12" : "col-sm-12 col-md-10" ?>  menu-container">	
						<div class="pull-right search-area">
                            <jdoc:include type="modules" name="header-search"/>
						</div>
						<div id="navbar" class="navbar-left hidden-xs">
							<?php if ($this->countModules('navbar')) : ?>
							<jdoc:include type="modules" name="navbar" role="navigation" />
							<?php endif; ?>	
						</div>
					</div>
				</div>			
			</div>			
		</div>
	</header>
	<!--Main Content-->
	<main id="content" role="main">
		<jdoc:include type="message" />
        <?php if ($isHome) {?>
		<?php if ($this->countModules('position-banner')) : ?>
			<div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="main-banner">
                            <jdoc:include type="modules" name="position-banner" />
                        </div>
                    </div>
                </div>
		    </div>
		<?php endif; ?>	
        <?php }?>
       <div class="main">
            <?php if ($isHome) {?>
            <?php if ($this->countModules('banner-1')) : ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- section-1 -->
                        <section class="banner_section">
                            <jdoc:include type="modules" name="banner-1" />
                        </section>
                    </div>
                </div>
            </div>
            <?php endif; ?>
           <?php if ($this->countModules('aside-filter')) : ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <jdoc:include type="modules" name="aside-filter" />
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!--Side-->
            <?php if ($this->countModules('section-destak')) : ?>
            <div class="container">
                <div class="row">
                    <section>
                        <jdoc:include type="modules" name="section-destak" />
                    </section>
                </div>
            </div>
            <?php endif; ?>
            <?php } 
                  else {?>
            <div class="container">
                <div class="row">
                    <?php if ($hasLeftCol) : ?>
                    <aside class="hidden-sm hidden-xs col-md-3 leftcol">
                        <jdoc:include type="modules" name="aside-left" />
                    </aside>
                    <?php endif; ?>
                    <div class="col-xs-12 <?php echo ($hasLeftCol) ? "col-md-9" : "" ?>">
                        <div class="row">
                            <jdoc:include type="component"/>
                            <?php if ($this->countModules('aside-category-filter')) : ?>
                            <div class="col-xs-12 col-sm-3">
                                <div class="filters-container buffer-before">
                                    Filtros:
                                    <jdoc:include type="modules" name="aside-category-filter" />
                               </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($hasRightCol) : ?>
                            <!-- sidebar -->
                            <aside class="hidden-sm hidden-xs col-md-4 buffer-before" id="sidebar">
                                <div id="insidebar">
                                    <jdoc:include type="modules" name="aside-right"/>
                                </div>
                            </aside>
                            <?php endif; ?>
                        </div>
                        <section class="row-after-art-1">
                            <jdoc:include type="modules" name="after-article-1"/>
                        </section>
                        <section class="row-after-art-2">
                            <jdoc:include type="modules" name="after-article-2"/>
                        </section>
                        <section class="row-after-art-3">
                            <jdoc:include type="modules" name="after-article-3"/>
                        </section>
                        <section class="row-after-art-4">
                            <jdoc:include type="modules" name="after-article-4"/>
                        </section>
                        <section class="row-after-art-5">
                            <jdoc:include type="modules" name="after-article-5"/>
                        </section>
                        <section class="row-after-art-6">
                           <jdoc:include type="modules" name="after-article-6"/>
                        </section>

                    </div>                                        

                </div>

            </div>

            <?php } ?>
            <div class="container row-after-art-all">
                <div class="row">
                    <jdoc:include type="modules" name="position-1"/>
                </div>
            </div>

           <?php if ($isHome) {?>
            <div id="noticias">
                <jdoc:include type="modules" name="noticias"/>
            </div>
            <?php } ?>
            <div class="container">
                <div class="row">
                    <jdoc:include type="modules" name="position-2" />
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <jdoc:include type="modules" name="position-3" />
                </div>
            </div>
        </div>
    </main>

	

	<!--Footer-->



	<footer class="footer <?php echo $footercolor?> <?php echo $footersize?>" role="contentinfo">

		<div class="container">

			<div class="row">

				<div class="col-md-2">

				<jdoc:include type="modules" name="footer" />

				</div>

				<div class="col-md-10 col-xs-12 menu-bottom">

                    <div class="row">

                        <div class="col-xs-6 col-sm-3">

                            <jdoc:include type="modules" name="position-4" />

                        </div>

                        <div class="col-xs-6 col-sm-3">

                            <jdoc:include type="modules" name="position-4.1"/>

                        </div>

                        <div class="clearfix hidden-lg hidden-md hidden-sm"></div>

                        <div class="col-xs-6 col-sm-3">

                            <jdoc:include type="modules" name="position-5"/>

                        </div>

                        <div class="col-xs-6 col-sm-3">

                            <jdoc:include type="modules" name="position-5.1"/>

                        </div>

                    </div>

				</div>

			</div>

			<div class="row">
			    <jdoc:include type="modules" name="position-6" />
    		</div>
			<div class="row">
       			<div class="pull-right">
				 <p class="copyright"><?php echo  htmlspecialchars($this->params->get('copyright')) ; ?></p>
				</div>
			</div>
		</div>
	</footer>	

	</div>

	<jdoc:include type="modules" name="debug" style="display:none;" />



</body>



</html>



