<?php
require_once('model.php');
session_start();
connect_db();

require_once('views/head.html');

if (isset($_GET['mode']) && $_GET['mode']!=""){
    $mode=htmlspecialchars($_GET['mode']);
} else {
    $mode="main";
}
switch($mode){
    case "login":
        login();
        break;
    case "logout":
        logout();
        break;
    case "tasks":
        view_tasks();
        break;
    case "alltasks":
        view_alltasks();
        break;
    case "add":
        add_tasks();
        break;
    case "modify":
        modify_tasks();
        break;
    case "delete":
        delete_tasks();
        break;
    default:
        include("views/main.html");
        break;
}
require_once('views/foot.html');