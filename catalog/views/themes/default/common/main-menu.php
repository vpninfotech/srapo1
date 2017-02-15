<style>


  #native {
    -webkit-column-width:   200px;
    -moz-column-width:      200px;
    -o-column-width:        200px;
    -ms-column-width:       200px;
    column-width:           200px;

    -webkit-column-rule-style:  solid;
    -moz-column-rule-style:     solid;
    -o-column-rule-style:       solid;
    -ms-column-rule-style:      solid;
    column-rule-style:      solid;
    }

</style>
<!-- Start : nav-top-menu -->
<div id="nav-top-menu" class="nav-top-menu">
    <div class="container">
        <div class="row">
           
            <div id="main-menu" class="col-sm-12 main-menu">
                <?php if ($header['categories']) { ?>
<nav class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="#">MENU</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav nav-justified">
       
        <?php foreach ($header['categories'] as $category) { ?>
        <?php if ($category['children']) { ?>
        <li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>
         
              <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
              
                
                    <ul class="mega_dropdown dropdown-menu" style="width:1170px;left:0px ;" id="native">
                <?php 
                $count = 1;

                foreach ($children as $child) { ?>
                
                        <?php if ($child['children']) { ?>
                        <li class="link_container group_header">
                                <a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>
                            </li>
                           <?php  foreach ($child['children'] as $sub_child) { ?>
                             <li class="link_container">
                                <a href="<?php echo $sub_child['href']; ?>"><?php echo $sub_child['name']; ?></a>
                              </li>
                         <?php }
                         } else { ?>
                            <li class="link_container group_header">
                                <a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>
                            </li>
                        <?php } ?>
                    
                <?php } ?>
                </ul>
               
              <?php } ?>
            
        </li>
        <?php } else { ?>
        <li ><a href="<?php echo $category['href']; ?>" class="dropdown-toggle"><?php echo $category['name']; ?></a></li>
        <?php } ?>
        <?php } ?>
      </ul>
      
    </div>
    </div>
  </nav>
<?php } ?>

        </div>
     </div>
  </div>
</div>
<!-- End : nav-top-menu -->