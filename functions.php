<?php

function top_sorted($args){
  $score = [];

  foreach ($args as $topID){
    $score[$topID] = floatval(get_post_meta($topID, 'bk_final_score', true));
  }

  arsort($score);
  return $score;

}
 


?>