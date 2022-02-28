<?php



function bd_bookmakers_directory_short($atts)
{
  $atts = shortcode_atts(
    array(
      'title' => '',
      'layout' => '',
      'limit' => '',
      'sort_by' => '', // (ASC, DESC) "meta_key"
      'cta' => '',
      'sorting_id' => '', // id = 1,2,3 TOP 3

    ),
    $atts,
    'table'
  );

  ob_start();

  wp_enqueue_style('custom_CSS');


  if ($GLOBALS['countryISO'] === 'glb') {
    $iso = '-';
  } else {
    $iso = $GLOBALS['countryISO'];
  }

  // Decode REST data and putting them into the $data array
  $data = rest_data();

  if (!empty($data) && is_array($data) && @$data['code'] <> "rest_no_route") {
    if ($atts['sorting_id'] <> "") {
      $valid_data = valid($data, $atts['sorting_id']);
    } else {
      $valid_data = valid($data);
    }

    $scores  = sorted_bookmakers($valid_data, $atts['sort_by']);

    if ('card-layout' == $atts['layout']) {

      if ($atts['title'] != "") {
?>
        <h3 style="text-align: justify;"> <?php echo $atts['title'] ?></h3>
      <?php
      }
      ?>




      <div id="builder" class="container-fluid bookmakers_directory p-0">
        <div class="d-flex flex-wrap w-100 justify-content-center">
          <?php
          $counter = 0;

          foreach ($scores as $key => $score) {

            if ($atts['limit'] <> "" && $counter > $atts['limit'] - 1) {
              break;
            }

            $terms = $valid_data[$key]["meta"]["shortcode_short_term_text-"][0] . $iso ? $valid_data[$key]["meta"]["shortcode_short_term_text-"][0] . $iso  : $valid_data[$key]["meta"]["default_long_term_text-"][0] . $iso;

            $bookerID_link = $valid_data[$key]["meta"]["affiliate_url_for_cta"][0];
            $score = floatval($valid_data[$key]["meta"]["bk_final_score"][0]);
            $color = $valid_data[$key]["meta"]["book_color"][0];
            $title = $valid_data[$key]["post_title"];
            $image =  $valid_data[$key]["meta"]["bookmakers_custom_meta_sidebar_icon"][0];

          ?>

            <div id="cards" class="d-flex flex-column bookmakers_rounded bookmakers_shadow-box cards_width" style="background-color: <?php echo $color; ?>; overflow:hidden;">
              <div class=" d-flex w-100 flex-column">
                <div class="heading-text" style="z-index:2; ">
                  <?php
                  if ($counter >= 9) {
                  ?>
                    <span class="ribbon_test-alt p-0" style=""><?= $counter + 1; ?></span>
                  <?php
                  } else {
                  ?>
                    <span class="ribbon_test p-0" style=""><?= $counter + 1; ?></span>
                  <?php
                  }
                  ?>
                </div>

                <div class="d-block bookmakers_my-3"></div>
                <div class=" d-flex justify-content-center">
                  <a class="" href="<?php echo esc_attr($bookerID_link); ?>" target="_blank">
                    <div class="bookmakers_mt-3">
                      <img class="bookmakers_img-fluid" src="<?php echo $image; ?>" alt="">
                    </div>
                  </a>
                </div>

                <div class=" d-block">
                </div>

                <div class="d-block text-center" style="z-index:2; background-color: <?= $color; ?>">
                  <span class=" d-none d-md-block"><a class="stoiximatikes-link-layout" href="<?php echo esc_attr($bookerID_link); ?>" target="_blank"><?php echo esc_attr(str_replace("Live", "gr", $title)) ?></a></span>
                  <div class="d-block ">
                    <div class=" d-flex justify-content-center align-self-center align-middle">

                      <?php

                      echo  $stars = userVotes::drawStarsDefault($score / 2, 20);
                      ?>

                    </div>
                  </div>
                </div>
              </div>
              <div class="m-0 d-flex flex-column justify-content-center">
                <button class="btn bookmakers_my-2 d-block button-text-large button-large-glossy position-relative align-self-center">
                  <a style="color:white!important;" rel="nofollow" href="<?php echo esc_attr($bookerID_link); ?>" target="_blank">
                    <?= $atts['cta'] ?>
                    <?php
                    if (empty($terms)) {
                      echo regulator($valid_data[$key]["ID"]);
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

      echo "<br>";
    ?>

      <div class="border border-primary m-0 p-0">

        <div class="d-block w-100 title-black text-center  p-0 m-0">
          <span class="text-center h1 mt-1 title-black sidebar-text-design" style="border-bottom: none;"><?php echo $atts['title']; ?></span>
        </div>

        <div class="mt-3 d-block border-bottom border-dark" style="height: 1rem;"></div>

        <?php
        $counter = 0;
        foreach ($scores as $key => $score) {

          if ($atts['limit'] <> "" && $counter > $atts['limit'] - 1) {
            break;
          }

          $terms = $valid_data[$key]["meta"]["shortcode_short_term_text-"][0] . $iso ? $valid_data[$key]["meta"]["shortcode_short_term_text-"][0] . $iso  : $valid_data[$key]["meta"]["default_long_term_text-"][0] . $iso;

          $bookerID_link = $valid_data[$key]["meta"]["affiliate_url_for_cta"][0];
          $color = $valid_data[$key]["meta"]["book_color"][0];
          $title = $valid_data[$key]["post_title"];
          $image =  $valid_data[$key]["meta"]["bookmakers_custom_meta_sidebar_icon"][0];

        ?>

          <div class="w-100 stripted-blue-row border-bottom border-dark">
            <div class=" m-0 pb-2 ">
              <div class="col-md-4 mt-5 pt-5 pb-2 bookmenu align-items-center">
                <a href="<?php echo $bookerID_link; ?>">
                  <div class="mt-3 bookmakers_p-3" style="background-color: <?php echo $color ?>;">
                    <img class="bookmakers_img-fluid" src="<?php echo $image; ?>" alt="">
                  </div>
                </a>
              </div>

              <div class="col-8 pr-2 pl-0 d-flex flex-column align-items-center">
                <div class="w-100 p-0">
                  <a class="text-center d-block text-danger stoiximatikes-link" href="<?php echo esc_attr($bookerID_link); ?>"><?php echo esc_attr(str_replace("Live", "gr", $title)) . " »"; ?></a>
                </div>
                <div class="w-100 d-md-block ">
                  <button class="btn btn-danger btn-sm d-block mx-auto button-text shadow rounded button-small-glossy position-relative">
                    <a class="" rel="nofollow" href="<?php echo esc_attr($bookerID_link); ?>" target="_blank"><?= $atts['cta'] ?>

                      <?php
                      if (empty($terms)) {
                        echo regulator($valid_data[$key]["ID"]);
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
              <small class="d-md-block w-100 text-center mt-5 pb-0 text-dark font-weight-light" style="display:block; text-align:center; color:black; font-size: 6px;margin-bottom: 1px; font-weight:600"><?= $terms ?></small>



            <?php
            }
            ?>
          </div>
        <?php
          $counter++;
        }
        ?>
        <div class="d-block mt-5" style="height: 0.5rem;"></div>
        <div class="w-100 d-md-block ">
          <button class="btn btn-danger w-100 mt-3 btn-md d-block shadow all-books-text button-text col-12">
            <a class="" href="<?php echo site_url("/stoiximatikes-etairies") ?>" target="_blank" style="font-size:14px">ΟΛΟΙ ΟΙ BOOKMAKERS</a>
          </button>
          <div class="d-block mt-5" style="height: 0.5rem;"></div>
        </div>


      </div>
<?php

    }
  }
  $output = ob_get_clean();

  return $output;
}
add_shortcode('bookmakers_directory_short', 'bd_bookmakers_directory_short');
