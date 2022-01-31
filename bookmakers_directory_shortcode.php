
<?php



function bookmakers_directory_short($atts)
{
  $atts = shortcode_atts(
    array(
      'title' => '',
      'layout' => '', 
      'limit' => '',
      'offset' => '',
      'sort_by' => '',
      'cta' => '',
      'download' => '',
      'mobile' => '',
      'legal' => '',
      'sorting_id' => '',
      'pay_in' => '',
      'pay_out' => '',
      'ids' => '',
    ),
    $atts,
    'table'
  );

  //geoountry
  ob_start();

  ?><style type="text/css"><?php include 'output.css'?></style><?php

  if ($GLOBALS['countryISO'] === 'glb') {
    $iso = '-';
  } else {
    $iso = $GLOBALS['countryISO'];
  }

  $allbookers = ShortcodeFilters::returnBookies($atts);

  if ('card-layout' == $atts['layout']) {
?>
  <h3 style="text-align: justify;"> <?php echo $atts['title'] ?></h3>
    <p>

    </p>

    <div class="container-fluid p-0">
      <div class="d-flex flex-wrap w-100 justify-content-center">
        <?php
        $counter = 0;
        foreach ($allbookers['books'] as $bookerID) {
          $terms = get_post_meta($bookerID, 'shortcode_short_term_text' . $iso, true) ? get_post_meta($bookerID, 'shortcode_short_term_text' . $iso, true) : get_post_meta($bookerID, 'default_long_term_text' . $iso, true);

          $bookerID_link = get_post_meta($bookerID,'affiliate_url_for_cta', true);
          $pros = explode('&lt;/p&gt;', get_post_meta($bookerID, 'book_prons', true));
          $score = floatval(get_post_meta($bookerID, 'bk_final_score', true));
          $image = get_post_meta($bookerID, 'bookmakers_custom_meta_sidebar_icon', true);
          $color = get_post_meta($bookerID, 'book_color', true);
          $title = get_the_title($bookerID);
        ?>
          <div class="col-md-3 p-0 m-sm-1 m-lg-2 mb-2 d-flex flex-column rounded-lg shadow-box" style="background-color: <?= $color; ?>; overflow:hidden; max-width:200px;">
            <div class=" d-flex w-100 flex-column">
              <div class="heading-text" style="z-index:1001;">
                <?php 
                  if($counter >= 9){
                   ?>
                    <span class="ribbon_test-alt p-0" style=""><?= $counter + 1; ?></span>
                    <?php
                  }else{
                    ?>
                      <span class="ribbon_test p-0" style=""><?= $counter + 1; ?></span>
                    <?php
                  }
                ?>
              </div>

                <div class=" d-flex justify-content-center bookmenu " >
                  <a class="" href="<?= get_the_permalink($bookerID); ?>" target="_blank">
                  <div class="image-control mt-3 spritesimg <?php echo str_replace(" ","",substr(str_replace("live","",strtolower($title)),0));?>">
                  </div>
                  </a>
                </div>

                <div class="my-5 d-block mt-0 ">
                </div>

                <div class="d-block text-center"style="z-index:1001; background-color: <?= $color; ?>">
                  <span class=" d-none d-md-block" ><a class="stoiximatikes-link-layout" href="<?php echo get_the_permalink($bookerID); ?>" target="_blank"><?php echo get_the_title($bookerID); ?></a></span>
                  <div class="d-block ">
                    <div class=" d-flex justify-content-center align-self-center align-middle">
                      <?php echo  $stars = userVotes::drawStarsDefault($score / 2, 20) ?>
                    </div>
                  </div>
                </div>
            </div>
              <div class="m-0 d-flex flex-column justify-content-center">
                <button class="btn my-2 d-block button-text-large button-large-glossy position-relative align-self-center"style="">
                  <a style="color:white!important;" rel="nofollow" href="<?php echo $bookerID_link; ?>" target="_blank">
                    <?= $atts['cta'] ?>
                    <?php
                    if (empty($terms)) {
                      echo regulator($bookerID);
                    }
                    ?>
                    <div class="shiny-animation-slow"><i></i></div>
                  </a>
                  <!--<span class="fa fa-arrow-circle-right"></span>-->
                </button>
                <?php
                if (!empty($terms)) {
                ?>
                  <small class="" style="display:block;text-align: center;color:white;font-size: 8px;margin-bottom: 5px;"><?= $terms ?></small>
                <?php
                }
                ?>
              </div>
          </div>
        <?php
          $counter++;
        }
        ?>
      </div>
    </div>

  <?php

  } elseif ('sidebar' == $atts['layout']) {
    
    // $sorted_top_scores =  top_sorted($bookerID['books']);
    echo "<br>";
  ?>
    
    <div class="container border border-primary m-0 p-0">
     
      <div class="d-block w-100 title-black text-center  p-0 m-0">
        <span class="text-center h1 small mt-1 title-black sidebar-text-design"><?php echo $atts['title'];?></span> 
      </div>
  
      <div class="mt-3 d-block border-bottom border-dark"></div>
    
      <?php
      $counter = 0;
      foreach ($allbookers['books'] as $bookerID){
        
        $terms = get_post_meta($bookerID, 'shortcode_short_term_text' . $iso, true) ? get_post_meta($bookerID, 'shortcode_short_term_text' . $iso, true) : get_post_meta($bookerID, 'default_long_term_text' . $iso, true);
        
        $booker_link = get_post_meta($bookerID,'affiliate_url_for_cta', true);
        // $score = floatval(get_post_meta($bookerID, 'bk_final_score', true));
        $color = get_post_meta($bookerID, 'book_color', true);
        $title = get_the_title($bookerID);
        
      ?>
        
        <div class="w-100 stripted-blue-row border-bottom border-dark">
          <div class="flex-wrap m-0 pb-2 d-flex ">
            <div class="col-md-4 pl-3 pt-2 align-self-center  bookmenu">
              <div class="shadow spritesimg <?php echo str_replace(" ","",substr(str_replace("live","",strtolower($title)),0));?>" style=" transform: scale(1.20);">
              </div>
            </div>
            
            <div class="col-8 pr-2 pl-0 d-flex flex-column align-items-center">
              <div class="w-100 p-0">
              <a class="text-center d-block text-danger stoiximatikes-link" href="<?php echo get_the_permalink($bookerID); ?>"><?php echo get_the_title($bookerID); ?> <span class="arrows"><i class="fas fa-angle-double-right"></i></span></a>
              </div>
              <div class="w-100 d-md-block ">
                <button class="btn btn-danger btn-sm d-block mx-auto button-text shadow rounded button-small-glossy position-relative"  > 
                  <a class="" rel="nofollow" href="<?php echo $booker_link; ?>" target="_blank">Εγγραφή <span class="arrows"><i class="fas fa-angle-double-right"></i></span>
                    <?= $atts['cta'] ?>
                    <?php
                    if (empty($terms)) {
                      echo regulator($bookerID);
                    }
                    ?>
                    <div class="shiny-animation"><i></i></div>
                    
                  </a>
                </button>
              </div>
            </div>
          </div>

          <?php
            if (!empty($terms)) {
          ?>
            <small class="d-md-block w-100 text-center pb-0 text-dark font-weight-light" style="display:block;text-align: center;color:white;font-size: 8px;margin-bottom: 1px;"><?= $terms ?></small>
          
            

          <?php
          }
          ?>
        </div>
       <?php
        $counter++;
      }
       ?>
      <div class="my-2 d-block mt-0 "></div>
      <div class="w-100 d-md-block ">
                <button class="btn btn-danger mb-2 btn-md d-block shadow all-books-text button-text col-12 m-0">
                  <a class="" href="<?php echo site_url("/stoiximatikes-etairies") ?>" target="_blank" style="font-size:14px">ΟΛΟΙ ΟΙ BOOKMAKERS</a>
                </button>       
      </div>
      <div class="my-1 d-block mt-0 "></div>

  </div>
  <?php
   
  }
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}
add_shortcode('bookmakers_directory_short', 'bookmakers_directory_short');
