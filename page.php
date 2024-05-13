<?php

class Page {
    
    static function showCreateDatabaseButton()
    {
        echo '
            <form method="post" action="database.php">
                <button id="btn-export" name="btn-export" title="Export to .CSV">
                    Create database
                </button>
            </form>';
    }

    static function showBackButton()
    {
        echo '
            <form method="post" action="index.php">
                <button id="btn-export" name="btn-export" title="">
                    Back
                </button>
            </form>';
    }
    static function showLoginButton()
    {
        echo '
            <form method="post" action="Login.php">
                <button id="btn-export" name="btn-export" title="">
                    Login
                </button>
            </form>';
    }

    static function head() {
        echo '
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
        ';
    }

    static function nav() {

    }
    static function footer() {
        echo '
        </body>
        </html>
        ';
    }

    static function createLogin() {
        echo"
        <style>
        #i1 {
            border: 1px solid black;
            padding: 5px;
            width: 20%;
            text-align: center;
            margin: auto;
            margin-top: 10%;
        }
        </style>
        <div id='i1'>
            <h2>Login</h2>
            <form method='post'>
                <label for='email'>E-mail</label><br>
                <input type='text' id='email' name='email'><br>
                <label for='pw'>Password</label><br>
                <input type='text' id='pw' name='pw'><br><br>
                <input type='submit' value='Submit'>
            </form>
            <br><br>
            <a href='forgotPassword.php'>Forgot password?</a>
            <a href='registration.php'>Registration</a>
        <div>
        ";
    }
    static function createNewPassword() {
        echo"
        <style>
        #i1 {
            border: 1px solid black;
            padding: 5px;
            width: 20%;
            text-align: center;
            margin: auto;
            margin-top: 10%;
        }
        </style>
        <div id='i1'>
            <h2>New Password</h2>
            <form method='post' action=''>
                <label for='email'>E-mail</label><br>
                <input type='text' id='email' name='email'><br><br>
                <input type='submit' value='Send e-mail'>
            </form>
            <br><br>
        <div>
        ";
    }

    static function createRegistration() {
        echo"
        <style>
        #i1 {
            border: 1px solid black;
            padding: 5px;
            width: 20%;
            text-align: center;
            margin: auto;
            margin-top: 10%;
        }
        </style>
        <div id='i1'>
            <h2>Registration</h2>
            <form method='post' action=''>
                <label for='name'>Name</label><br>
                <input type='text' id='name' name='name'><br>
                <label for='email'>E-mail</label><br>
                <input type='text' id='email' name='email'><br>
                <label for='pw'>Password</label><br>
                <input type='text' id='pw' name='pw'><br>
                <label for='pw2'>Password again</label><br>
                <input type='text' id='pw2' name='pw2'><br><br>
                <input type='submit' value='Submit'>
            </form>
            <br><br>
        <div>
        ";
    }

    static function createVerification() {
        echo"
        <style>
        #i1 {
            border: 1px solid black;
            padding: 5px;
            width: 20%;
            text-align: center;
            margin: auto;
            margin-top: 10%;
        }
        </style>
        <div id='i1'>
            <h2>Verification</h2>
            <form method='post' action=''>
                <label for='num'>Numbers</label><br>
                <input type='number' id='num' name='num'><br><br>
                <input type='submit' value='Submit'>
            </form>
            <br><br>
        <div>
        ";
    }

    static function emailBody($token) {
        return "<p>Here is your verification token: '$token'</p>
        <p>Return to login: <a href='http://localhost:8000/login/login.php' target='_blank'>Click Here</a></p>";
    }

    static function logoutButton() {
        echo '
            <form method="post" action="">
                <button id="logout" name="logout" title="logout">
                    Logout
                </button>
            </form>';
    }
}

?>