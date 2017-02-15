<?php
        // Start: set-Home bottom left Images
           $home_bottom_left_banner =array();
           $home_bottom_left_banner_list = $this->banner->getBanner('home','bottom left');

           foreach ($home_bottom_left_banner_list as $bottom_left_banner) 
            {
                   if (is_file(DIR_IMAGE . $bottom_left_banner['image'])) 
                   {                
                        $image = $this->image->resize($bottom_left_banner['image'], 570, 120);
                    } 
                    else 
                    {
                        $image = $this->image->resize('no_image.png', 570, 120);
                    }
                  $home_bottom_left_banner['image'] = $image ;
                  if($bottom_left_banner['link'])
                  {
                     $home_bottom_left_banner['link'] = $bottom_left_banner['link']; 
                  }
                  else
                  {
                     $home_bottom_left_banner['link'] = '#';
                  }
                 
                  break;
            }

            if(!isset($home_bottom_left_banner['image']))
            {
                $home_bottom_left_banner['image'] = $image = $this->image->resize('no_image.png', 570, 120);
            }

            if( !isset($home_bottom_left_banner['link']))
            {
                $home_bottom_left_banner['link'] = '#';
            }
        // End: set-Home bottom left Images

        // Start: set-Home bottom Right Images
           $home_bottom_right_banner =array();
           $home_bottom_right_banner_list = $this->banner->getBanner('home','bottom right');

           foreach ($home_bottom_right_banner_list as $bottom_right_banner) 
            {
                   if (is_file(DIR_IMAGE . $bottom_right_banner['image'])) 
                   {                
                        $image = $this->image->resize($bottom_right_banner['image'], 570, 120);
                    } 
                    else 
                    {
                        $image = $this->image->resize('no_image.png', 570, 120);
                    }
                  $home_bottom_right_banner['image'] = $image ;
                  if($bottom_right_banner['link'])
                  {
                     $home_bottom_right_banner['link'] = $bottom_right_banner['link']; 
                  }
                  else
                  {
                     $home_bottom_right_banner['link'] = '#';
                  }
                 
                  break;
            }

            if(!isset($home_bottom_right_banner['image']))
            {
                $home_bottom_right_banner['image'] = $image = $this->image->resize('no_image.png', 570, 120);
            }

            if( !isset($home_bottom_right_banner['link']))
            {
                $home_bottom_right_banner['link'] = '#';
            }
        // End: set-Home bottom left Images
?>
<!-- Start : banner bottom -->
<div class="container">
<!-- Baner bottom -->
<div class="row banner-bottom">
    <div class="col-sm-6">
        <div class="banner-boder-zoom">
            <a href="<?php echo $home_bottom_left_banner['link']; ?>"><img alt="Add Left" class="img-responsive" src="<?php echo $home_bottom_left_banner['image']; ?>" /></a>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="banner-boder-zoom">
            <a href="<?php echo $home_bottom_right_banner['link']; ?>"><img alt="Add Left" class="img-responsive" src="<?php echo $home_bottom_right_banner['image']; ?>" /></a>
        </div>
    </div>
</div>
<!-- end banner bottom -->

<!-- Start : featured category sports -->
 <?php if ($header['categories']) { 

    ?>
<!-- Start : Hot Categories -->
<div id="content-wrap">
    <div class="container">
        <div id="hot-categories" class="row">
            <div class="col-sm-12 group-title-box">
                <h2 class="group-title ">
                    <span>Hot categories</span>
                </h2>
            </div>
                <?php //echo "<pre>";print_r($header['categories']);exit;
                    $total_display_hot_categories =$this->common->config('config_display_hot_categories');
                    $total_display_hot_sub_categories =$this->common->config('config_display_hot_sub_categories');
                    $count_category = 0;
                    $category_image ="";
                     $div_count=1;

                    foreach ($header['categories'] as $key => $category) 
                    {

                        if($count_category == $total_display_hot_categories)
                        {
                            break;
                        }
                        $count_category++;

                       if (is_file(DIR_IMAGE . $category['image'])) 
                       {                
                            $category_image = $this->image->resize($category['image'], 117, 92);
                        } 
                        else 
                        {
                            $category_image = $this->image->resize('no_image.png', 117, 92);
                        }

                    ?>
                          <div class="col-sm-6  col-lg-3 cate-box">
                            <div class="cate-tit" >
                                <div class="div-1" style="width: 46%;">
                                    <div class="cate-name-wrap">
                                        <p class="cate-name"><?php echo $category['name'];?></p>
                                    </div>
                                    <a href="<?php echo $category['href'];?>" class="cate-link link-active" data-ac="flipInX" ><span>shop now</span></a>
                                </div>
                                <div class="div-2" >
                                    <a href="<?php echo $category['href'];?>">
                                        <img src="<?php echo $category_image;?>" alt="<?php echo $category['name'];?>" class="hot-cate-img" />
                                    </a>
                                </div>
                                
                            </div>
                            <div class="cate-content">
                            <ul>
                            <?php if ($category['children']) 
                            {
                                foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) 
                                {
                                    $count_sub_category = 0;
                                     foreach ($children as $child) 
                                     { 
                                         if($count_sub_category == $total_display_hot_sub_categories)
                                        {
                                            break;
                                        }
                                        $count_sub_category++;
                                        ?>
                                        <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                                <?php }
                                }

                            }
                                ?>
                                
                                </ul>
                            </div>
                        </div> <!-- /.cate-box -->
                    <?php
                      if($div_count ==4)
                      {
                        echo "</div><div class='row indra'>";
                      }
                      $div_count++;
                    }
                }
                ?>
                                                      
        </div> <!-- /#hot-categories -->
        
    </div> <!-- /.container -->
</div>
<!-- End : Hot Categories -->