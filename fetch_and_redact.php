<?php

require "helpers.php";

/**
 * @param $value
 * @return string
 */
function hash_value($value)
{
    return base64_encode($value);
}

/**
 *
 */
function curl()
{
    $output_filename = "users.json";
    $url = "https://tst-api.feeditback.com/exam.users";
    $username = "dev_test_user";
    $password = "V8(Zp7K9Ab94uRgmmx2gyuT.";
    
    // curl call to the url above to fetch data
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    
    $result = json_decode($output);
    
    // deduce the data from the fetched data as per the instructions
    foreach ($result as $element) {
        unset($element->latitude);
        unset($element->longitude);
        $element->email = hash_value($element->email);
        if (!strlen($element->address) <= 2) {
            $element->address = get_starred($element->address);
        }
    }
    
    // the following lines write the contents to a file in the same directory (provided permissions etc)
    $fp = fopen($output_filename, 'w');
    fwrite($fp, json_encode($result));
    fclose($fp);
}

/**
 * @param $str
 * @return string
 * this function is used to add stars to the characters of the string passed
 */
function get_starred($str)
{
    $words = explode(' ', $str);
    $newWords = [];
    foreach ($words as $key => $value) {
        if ($key == 0) {
            $newWords[$key] = $value;
            continue;
        }
        $newWords[$key] = repStr($value, 2);
    }
    
    $ss = implode(' ', $newWords);
    return $ss;
}

/**
 * @param $str
 * @param  int  $first
 * @param  string  $rep
 * @return string
 * replace characters with stars
 */
function repStr($str, $first = 0, $rep = '*')
{
    $begin = substr($str, 0, $first);
    $middle = str_repeat($rep, strlen(substr($str, $first)));
    $stars = $begin.$middle;
    return $stars;
}

curl();
