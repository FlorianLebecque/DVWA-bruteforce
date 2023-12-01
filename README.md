# DVWA-bruteforce
Brute force script for the main login page and for the bruteforce page,

Works in low/med and high security

The scripts works by testing multiple user and password pair.

```php
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
```

For the main login page -> `script.php`
for the bruteforce page -> `bruteforce.php`
