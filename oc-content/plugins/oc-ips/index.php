<?php 

add_hook("register_law_enforcement_success", "invisionCommunityRegister");

function invisionCommunityRegister($name, $email, $password, $division)
{

    error_log($division);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/ips/api/index.php?/core/members',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('name' => $name, 'email' => $email, 'password' => $password),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic OTlhMjg5MjMwMjIwZWZiMjNlODM5OWJkMmExYTc1YzQ6',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
}