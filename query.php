<?php

require "helpers.php";
/**
 * @param $field
 * @param $value
 * @param  bool  $exact
 */
function query($field, $value, $exact = true)
{
    $filepath = './users.json';
    $json = json_decode(file_get_contents($filepath), true);
    $data = array_filter($json);
    
    $updatedData = [];
    foreach ($data as $arr) {
        if ($field == 'email') {
            //decode back the email addresses to strings
            $value = base64_decode($arr[$field]);
            if ($arr[$field] == $value) {
                $updatedData = [
                    'first_name' => $arr['first_name'],
                    'last_name' => $arr['last_name']
                ];
            }
        } elseif ($arr[$field] == $value) {
            $updatedData = [
                'first_name' => $arr['first_name'],
                'last_name' => $arr['last_name']
            ];
        }
    }
    report($updatedData);
//    echo $updatedData;
}

/**
 * @param $data
 */
function report($data)
{
    $fp = fopen('users-report.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);
}

query('id', '5be5884a7ab109472363c6cd');
query('id', '5be5884a331b2c695', false);
query('id', '5be5884a331b24639s3cc695');
query('age', '22');
query('age', '20');
query('about', 'exa', false);
query('about', 'ace', false);
query('email', 'mcconnellbranch@zytrek.com');
query('email', 'ryansand@xandem.com');
query('email', 'edwinachang', false);

//report();
