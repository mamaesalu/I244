<?php

function connect_db(){
    global $connection;
    $host="localhost";
    $user="test";
    $pass="t3st3r123";
    $db="test";
    $connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
    mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

function login(){
    global $connection;
    global $errors;
    #global $userid;
    if (!empty($_SESSION['user'])){
        header("Location: ?page=tasks");
    }
    else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = array();
            if (!empty($_POST['user'])) {

            } else $errors[] = "Sisestage kasutajanimi";
            if (!empty($_POST['pass'])) {

            } else $errors[] = "Sisestage parool";

            if (empty($errors)) {
                $user = mysqli_real_escape_string($connection, $_POST["user"]);
                $parool = mysqli_real_escape_string($connection, $_POST["pass"]);
                $sql = "SELECT id, usern FROM maile_users WHERE usern = '$user' and passw= SHA1('$parool')";
                $result = mysqli_query($connection, $sql) or die ("ei saa parooli ja kasutajat kontrollitud".mysqli_error($connection));
                #$rida = mysqli_num_rows($result);
                if ($result && $user = mysqli_fetch_assoc($result)){
                    $_SESSION['user'] = $user;
                    #$userid = $rida[id];
                    header("Location: ?mode=tasks");
                } else {
                    header("Location: ?mode=login");
                }
            }
        }
    }
    include_once('views/login.html');
}

function logout(){
    $_SESSION=array();
    session_destroy();
    header("Location: ?");
}

function view_tasks(){
    global $connection;
    if (empty($_SESSION['user'])) {
        header("Location: ?mode=login");
    }
    $tasks = array();
    $userid = mysqli_real_escape_string($connection, $_SESSION['user']['id']);
    $sql = "SELECT * FROM maile_tasks WHERE user_id = '$userid'";
    $db_tasks = mysqli_query($connection, $sql) or die ("ei saanud ylesandeid andmebaasist kätte");
    while ($db_task = mysqli_fetch_assoc($db_tasks)){
        $tasks[] = $db_task;
    }

    include_once('views/tasks.html');
}

function view_alltasks(){
    global $connection;
    if (empty($_SESSION['user'])) {
        header("Location: ?mode=login");
    }
    if ($_SESSION['user']['usern'] != 'admin'){
        header("Location: ?mode=tasks");
    }
    $tasks = array();
    #$userid = mysqli_real_escape_string($connection, $_SESSION['user']['id']);
    if ($_SESSION['user']['usern'] == 'admin') {
        $sql = "SELECT * FROM maile_tasks ORDER BY user_id ASC";
        $db_tasks = mysqli_query($connection, $sql) or die ("ei saanud ylesandeid andmebaasist kätte");
        while ($db_task = mysqli_fetch_assoc($db_tasks)) {
            $tasks[] = $db_task;
        }
    }

    include_once('views/alltasks.html');
}

function add_tasks(){
    global $connection;
    if (empty($_SESSION['user'])) {
        header("Location: ?mode=login");
        exit(0);
    }
    if(!empty($_POST)){
        $errors=array();
        if (empty($_POST['task'])){
            $errors[]="lisa ülesande kirjeldus!";
        }
        if (empty($_POST['categ'])){
            $errors[]="vali ülesandele kategooria!";
        }
        if (empty($_POST['deadline'])){
            $errors[]="lisa täitmise tähtaeg!";
        }
        if (empty($errors)){
            $task=mysqli_real_escape_string($connection ,$_POST['task']);
            $categ=mysqli_real_escape_string($connection,$_POST['categ']);
            $deadline=mysqli_real_escape_string($connection,$_POST['deadline']);
            $user=mysqli_real_escape_string($connection,$_SESSION['user']['id']);

            $sql="INSERT INTO maile_tasks (user_id, categ, task, deadline) VALUES ('$user', '$categ', '$task', '$deadline')";
            $result = mysqli_query($connection, $sql);
            if ($result){
                $id = mysqli_insert_id($connection);
                $_SESSION['message']="postitamine õnnestus";
                header("Location: ?mode=tasks");
                exit(0);
            } else {
                $errors[]="ülesande lisamine ei õnnestunud";
            }
        }
    }
    include_once('views/add.html');
}