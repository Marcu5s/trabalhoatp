<!--==============================header=================================-->
 <header> 
 <div class="container_12">
  <div class="grid_12">
      <h1>
        <a href="<?php echo PATH_HTTP ?>">
          <img src="<?php echo Controller::Assets() ?>images/logo.png" alt="Your Happy Family">
        </a>
      </h1>   
      <form id="search" action="search.php" method="GET">
        <input type="text" name="s">                           
        <a onClick="document.getElementById('search').submit()" class="">
        </a>
        <div class="clear"></div>
      </form>
      <div class="clear"></div> 
    <div class="menu_block">
   
           <nav   class="" >
            <ul class="sf-menu">
                   <li class="current "><a href="<?php echo PATH_HTTP ?>">Home</a></li>
                   <li><a href="index-1.html">About</a></li>
                   <li><a href="index-2.html">Events</a></li>
                   <li><a href="index-3.html">Media</a></li>
                   <li><a href="index-4.html">Blog </a><ul>
                        <li><a href="#">Dolore ipsu</a></li>
                        <li><a href="#">Consecte</a> 
                            <ul>
                            <li><a href="#">Dolore ipsu</a></li>
                            <li><a href="#">Consecte</a></li>
                            <li><a href="#">Elit Conseq</a></li>
                          </ul>
                        </li>
                        <li><a href="#">Elit Conseq</a></li>
                     </ul></li>
                   <li><a href="<?php echo PATH_HTTP ?>?pg=voting">Votar </a></li>
                 </ul>
        </nav>
            <div class="clear"></div>
          
      </div>
  </div>
 </div> 