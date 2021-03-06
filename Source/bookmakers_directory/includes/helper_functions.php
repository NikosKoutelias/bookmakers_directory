<?php

// Fetch bookmakers object and cache it

function rest_data()
{
    $memcache_obj = new Memcache;
    $memcache_obj->connect('localhost', 11211);

    $memcache_resp = $memcache_obj->get('bd_bookmakers');

    $url = site_url() . '/wp-json/bookmakersdirectory/data';
    if (!$memcache_resp || @$memcache_resp['code'] == "rest_no_route") {
        $response = wp_remote_get($url);
        $data = json_decode(wp_remote_retrieve_body($response), true);
        $memcache_resp = $memcache_obj->set('bd_bookmakers', $data, MEMCACHE_COMPRESSED, (60 * 60 * 24));
        $memcache_resp = $memcache_obj->get('bd_bookmakers');
    }

    return $memcache_resp;
}


function valid($data, $names = "")
{

    $count = count($data);

    if ($names <> "") {
        $idarr = explode(",", $names);
        $id_count = count($idarr);
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < $id_count; $j++) {
                if ($idarr[$j] == $data[$i]["ID"] && !($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on" || $data[$i]["post_status"] !== "publish")) {
                    $new_data[$i] = $data[$i];
                }
            }
            unset($data[$i]);
        }
        return $new_data;
    } else {
        for ($i = 0; $i < $count; $i++) {
            if ($data[$i]["meta"]["bookmakers_custom_meta_hidden"][0] == "on" || $data[$i]["post_status"] != "publish") {

                unset($data[$i]);
            }
        }
    }

    return $data;
}

function arrays_data($data, $search_item)
{

    foreach ($data as $key => $row) {

        $arr[$key] = floatval($row["meta"][$search_item][0]);
    }
    return $arr;
}


function sorted_bookmakers($data, $type)
{
    $type_before = strstr($type, ' ', true);
    $type_after = trim(strstr($type, ' ', false));

    if ($type_before == "ASC") {

        switch ($type_after) {

            case "bk_cs6":

                $other_score = arrays_data($data, "bk_cs6");
                asort($other_score);
                return $other_score;

                break;

            case "bk_cs5":

                $other_score = arrays_data($data, "bk_cs5");
                asort($other_score);
                return $other_score;

                break;

            case "bk_cs4":

                $other_score = arrays_data($data, "bk_cs4");
                asort($other_score);
                return $other_score;

                break;

            case "bk_cs3":


                $other_score = arrays_data($data, "bk_cs3");
                asort($other_score);
                return $other_score;

                break;

            case "bk_cs2":

                $other_score = arrays_data($data, "bk_cs2");
                asort($other_score);
                return $other_score;

                break;

            case "bk_cs1":


                $other_score = arrays_data($data, "bk_cs1");
                asort($other_score);
                return $other_score;

                break;

            default:

                $final_score = arrays_data($data, "bk_final_score");
                asort($final_score);
                return $final_score;
        }
    } elseif ($type_before == "DESC") {

        switch ($type_after) {

            case "bk_cs6":

                $other_score = arrays_data($data, "bk_cs6");
                arsort($other_score);
                return $other_score;

                break;

            case "bk_cs5":

                $other_score = arrays_data($data, "bk_cs5");
                arsort($other_score);
                return $other_score;

                break;

            case "bk_cs4":

                $other_score = arrays_data($data, "bk_cs4");
                arsort($other_score);
                return $other_score;

                break;

            case "bk_cs3":

                $other_score = arrays_data($data, "bk_cs3");
                arsort($other_score);
                return $other_score;

                break;

            case "bk_cs2":

                $other_score = arrays_data($data, "bk_cs2");
                arsort($other_score);
                return $other_score;

                break;

            case "bk_cs1":

                $other_score = arrays_data($data, "bk_cs1");
                arsort($other_score);
                return $other_score;

                break;

            default:

                $final_score = arrays_data($data, "bk_final_score");
                arsort($final_score);
                return $final_score;
        }
    } else {

        $final_score = arrays_data($data, "bk_final_score");
        return $final_score;
    }
}
