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
      // 'pay_in' => '',
      // 'pay_out' => '',
      // 'ids' => '',
      // 'download' => '',
      // 'mobile' => '',
      // 'legal' => '',
      //'offset' => '',
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

  if (!empty($data) && is_array($data)) {
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
      <div class="container-fluid bookmakers_directory p-0">
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
          ?>

            <div class="d-flex flex-column rounded-lg shadow-box cards_width" style="background-color: <?= $color; ?>; overflow:hidden;">
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

                <div class=" d-flex justify-content-center bookmenu " style="position: relative;">
                  <a class="" href="<?= get_the_permalink($valid_data[$key]["ID"]); ?>" target="_blank">
                    <div class="image-control mt-3 spritesimg <?php echo str_replace(" ", "", substr(str_replace("live", "", strtolower($title)), 0)); ?>">
                    </div>
                  </a>
                </div>

                <div class="my-5 d-block mt-0 ">
                </div>

                <div class="d-block text-center" style="z-index:2; background-color: <?= $color; ?>">
                  <span class=" d-none d-md-block"><a class="stoiximatikes-link-layout" href="<?php echo get_the_permalink($valid_data[$key]["ID"]); ?>" target="_blank"><?php echo get_the_title($valid_data[$key]["ID"]); ?></a></span>
                  <div class="d-block ">
                    <div class=" d-flex justify-content-center align-self-center align-middle">
                      <?php echo  $stars = userVotes::drawStarsDefault($score / 2, 20) ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="m-0 d-flex flex-column justify-content-center">
                <button class="btn my-2 d-block button-text-large button-large-glossy position-relative align-self-center">
                  <a style="color:white!important;" rel="nofollow" href="<?php echo $bookerID_link; ?>" target="_blank">
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

      <div class="container border border-primary m-0 p-0">

        <div class="d-block w-100 title-black text-center  p-0 m-0">
          <span class="text-center h1 small mt-1 title-black sidebar-text-design"><?php echo $atts['title']; ?></span>
        </div>

        <div class="mt-3 d-block border-bottom border-dark"></div>

        <?php
        $counter = 0;
        foreach ($scores as $key => $score) {

          if ($atts['limit'] <> "" && $counter > $atts['limit'] - 1) {
            break;
          }

          $terms = $valid_data[$key]["meta"]["shortcode_short_term_text-"][0] . $iso ? $valid_data[$key]["meta"]["shortcode_short_term_text-"][0] . $iso  : $valid_data[$key]["meta"]["default_long_term_text-"][0] . $iso;

          $bookerID_link = $valid_data[$key]["meta"]["affiliate_url_for_cta"][0];
          $pros = explode('&lt;/p&gt;', $valid_data[$key]["meta"]['book_prons'][0]);
          $score = floatval($valid_data[$key]["meta"]["bk_final_score"][0]);
          $image = $valid_data[$key]["meta"]["bookmakers_custom_meta_sidebar_icon"][0];
          $color = $valid_data[$key]["meta"]["book_color"][0];
          $title = $valid_data[$key]["post_title"];

        ?>

          <div class="w-100 stripted-blue-row border-bottom border-dark">
            <div class="flex-wrap m-0 pb-2 d-flex ">
              <div class="col-md-4 pl-3 pt-2 align-self-center  bookmenu">
                <div class="shadow spritesimg <?php echo str_replace(" ", "", substr(str_replace("live", "", strtolower($title)), 0)); ?>" style=" transform: scale(1.20);">
                </div>
              </div>

              <div class="col-8 pr-2 pl-0 d-flex flex-column align-items-center">
                <div class="w-100 p-0">
                  <a class="text-center d-block text-danger stoiximatikes-link" href="<?php echo get_the_permalink($valid_data[$key]["ID"]); ?>"><?php echo get_the_title($valid_data[$key]["ID"]); ?> <span class="arrows"><i class="fas fa-angle-double-right"></i></span></a>
                </div>
                <div class="w-100 d-md-block ">
                  <button class="btn btn-danger btn-sm d-block mx-auto button-text shadow rounded button-small-glossy position-relative">
                    <a class="" rel="nofollow" href="<?php echo $bookerID_link; ?>" target="_blank"><?= $atts['cta'] ?> <span class="arrows"><i class="fas fa-angle-double-right"></i></span>

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
  }
  $output = ob_get_clean();

  return $output;
}
add_shortcode('bookmakers_directory_short', 'bd_bookmakers_directory_short');
