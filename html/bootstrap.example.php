  
  <!-- NAVBAR -->
  <nav class="navbar navbar-default hidden-sm hidden-md" role="navigation">
    <div class="container">

     
      <div class="navbar-header hidden-sm">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo $this->baseurl; ?>/"><?php echo $app->getCfg('sitename'); ?></a>
      </div>

      <div class="collapse navbar-collapse" id="navbar-modules">
        <jdoc:include type="modules" name="navbar" />

      </div>
      <div class="collapse navbar-collapse hidden-sm hidden-md">

          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
    </div>
    </div>
  </nav>

      <div class="header hidden-md hidden-lg">
          <a href="#menu" onclick="Callmenu();"></a>
      </div>
      

  <!-- BREADCRUMBS -->
  <div class="container">
    <jdoc:include type="modules" name="breadcrumbs" />
  </div>
  
  <!-- CONTENT -->
  <div class="container">
    <div class="row">
      <div class="col-lg-1"></div>

      <!-- content -->
      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
        <jdoc:include type="message" />
        <jdoc:include type="component" />
      </div> 

      <div class="col-md-1 col-lg-1"></div>

      <!-- sidebar -->
      <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3" id="sidebar">
        <div id="insidebar">
          <jdoc:include type="modules" name="sidebar" style="well" />
        </div>
      </div>

      <div class="col-lg-1"></div>
    </div>
  </div>

