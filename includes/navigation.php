<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">

    <ul class="social nav navbar-nav pull-left">
 <li class="list-inline-item">
      <a class="btn-floating btn-tw mx-1">
        <i class=" fa fa-twitter-square fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
      </a>
    </li>
    <li class="list-inline-item">
      <a class="btn-floating btn-fb mx-1">
        <i class=" fa fa-facebook-square fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
      </a>
    </li>
    <li class="list-inline-item">
      <a class="btn-floating btn-ins mx-1">
        <i class=" fa fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
      </a>
    </li>
</ul>
    <div class="navbar-header"> 
      <a class="navbar-brand" href="#">OWE-Todolist</a> 
    </div>


     <ul class="nav navbar-nav pull-right"> 
      <li class="dropdown"> 
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><!-- <i class="fa fa-user text-uppercase"></i> --><img class="nav-img img-circle" src="<?php echo $user->image?>" alt=""> <span class='text-uppercase'>  <?php echo $user->username?> </span><b class="caret"></b></a>

          <ul class="dropdown-menu"> 
            <li><a href='includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Logout</a></li>
            <li><a href='profile.php'><i class='fa fa-user'></i> Profile</a></li>";
          </ul>
        </li>
      </ul>
      
  </div>
</div>

    
</nav>

