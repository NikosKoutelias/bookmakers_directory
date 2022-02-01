<?php

function rest_data(){

    $url = site_url() . '/wp-json/customroutes/bookmakersdata';
    $response = wp_remote_get($url);

    return json_decode(wp_remote_retrieve_body($response),true);
    }   

function sorted_bookmakers($data, $type){

    for ($i = 0; $i < count($data); $i++){

        if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
          continue;
        } 
        $final_score[$i] = floatval($data[$i]["meta"]["bk_final_score"][0]);
    }

    if($type == "ASC"){

        sort($final_score);
        return $final_score;

    }elseif($type == "DESC"){

        rsort($final_score);
        return $final_score;
    }
    else{

      $type_before = strstr($type,' ',true);
      $type_after = strstr($type,' ',false);

      if ($type_after == "ASC"){

        switch($type_before){

            case "bk_cs6":

                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs6"][0]);
                    
                }
                sort($other_score);
                return $other_score;

            break;

            case "bk_cs5":

                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs5"][0]);
                    
                }
                sort($other_score);
                return $other_score;

            break;
            
            case "bk_cs4":
                
                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs4"][0]);
                    
                }
                sort($other_score);
                return $other_score;

            break;

            case "bk_cs3":

                
                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs3"][0]);
                    
                }
                sort($other_score);
                return $other_score;

            break;

            case "bk_cs2":

                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs2"][0]);
                    
                }
                sort($other_score);
                return $other_score;

            break;

            case "bk_cs1":

                
                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs1"][0]);
                    
                }
                sort($other_score);
                return $other_score;

            break;
        }
        
      }
      elseif($type_after = "DESC"){

        switch($type_before){

            case "bk_cs6":

                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs6"][0]);
                    
                }
                rsort($other_score);
                return $other_score;

            break;

            case "bk_cs5":

                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs5"][0]);
                    
                }
                rsort($other_score);
                return $other_score;

            break;
            
            case "bk_cs4":
                
                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs4"][0]);
                    
                }
                rsort($other_score);
                return $other_score;

            break;

            case "bk_cs3":

                
                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs3"][0]);
                    
                }
                rsort($other_score);
                return $other_score;

            break;

            case "bk_cs2":

                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs2"][0]);
                    
                }
                rsort($other_score);
                return $other_score;

            break;

            case "bk_cs1":

                
                for ($i = 0; $i < count($data); $i++){

                    if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on"){
                      continue;
                    } 
                    $other_score[$i] = floatval($data[$i]["meta"]["bk_cs1"][0]);
                    
                }
                rsort($other_score);
                return $other_score;

            break;

        }
       
      }else{
          throw "error";
      }

    }


     

}


  ?>