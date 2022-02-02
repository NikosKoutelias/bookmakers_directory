<?php



function rest_data(){

    $url = site_url() . '/wp-json/customroutes/bookmakersdata';
    $response = wp_remote_get($url);

    return json_decode(wp_remote_retrieve_body($response),true);
    }   


function valid($data){

    $count = count($data);
    for ($i = 0; $i < $count; $i++){

        if($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on" || $data[$i]["post_status"] != "publish"){
          
            unset($data[$i]);
        } 
        //$valid[$i] = floatval($data[$i]["meta"]["bk_final_score"][0]);
    }

    return $data;
}

function arrays_data($data,$search_item){

    foreach($data as $key => $row){

        $arr[$key] = floatval($row["meta"][$search_item][0]);   
    }
    return $arr;
}

function sorted_bookmakers($data, $type){

    if($type == "ASC"){

        $final_score = arrays_data($data,"bk_final_score");
        asort($final_score);
        return $final_score;

    }elseif($type == "DESC"){

        $final_score = arrays_data($data,"bk_final_score");
        arsort($final_score);
        return $final_score;
    }
    else{

      $type_before = strstr($type,' ',true);
      $type_after = trim(strstr($type,' ',false));

      if ($type_before == "ASC"){

        switch($type_after){

            case "bk_cs6":

                $other_score = arrays_data($data,"bk_cs6");   
                asort($other_score);
                return $other_score;

            break;

            case "bk_cs5":

                $other_score = arrays_data($data,"bk_cs5");   
                asort($other_score);
                return $other_score;

            break;
            
            case "bk_cs4":
                
                $other_score = arrays_data($data,"bk_cs4");
                asort($other_score);
                return $other_score;

            break;

            case "bk_cs3":

                
                $other_score = arrays_data($data,"bk_cs3");
                asort($other_score);
                return $other_score;

            break;

            case "bk_cs2":

                $other_score = arrays_data($data,"bk_cs2");
                asort($other_score);
                return $other_score;

            break;

            case "bk_cs1":

                
                $other_score = arrays_data($data,"bk_cs1");
                asort($other_score);
                return $other_score;

            break;

            default:

            $final_score = arrays_data($data,"bk_final_score");
            return $final_score;
        }
        
      }
      elseif($type_before == "DESC"){

        switch($type_after){

            case "bk_cs6":

                $other_score = arrays_data($data,"bk_cs6");
                arsort($other_score);
                return $other_score;

            break;

            case "bk_cs5":

                $other_score = arrays_data($data,"bk_cs5");
                arsort($other_score);
                return $other_score;

            break;
            
            case "bk_cs4":
                
                $other_score = arrays_data($data,"bk_cs4");
                arsort($other_score);
                return $other_score;

            break;

            case "bk_cs3":
          
                $other_score = arrays_data($data,"bk_cs3");
                arsort($other_score);
                return $other_score;

            break;

            case "bk_cs2":

                $other_score = arrays_data($data,"bk_cs2");
                arsort($other_score);
                return $other_score;

            break;

            case "bk_cs1":
  
                $other_score = arrays_data($data,"bk_cs1");
                arsort($other_score);
                return $other_score;
                
            break;
            
            default:

                $final_score = arrays_data($data,"bk_final_score");
                return $final_score;
        }
       
      }else{

            $final_score = arrays_data($data,"bk_final_score");
            return $final_score;
      }
    }
}
       


  ?>