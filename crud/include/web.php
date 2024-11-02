<?php


define("SERVER", "http://localhost/");

define("FOLDER", "todolist/crud");

define("domain", SERVER.FOLDER);

define("DASHBOARD", domain."/dashboard.php");

define("INSERT_FROM", domain."/action/listaction.php");

define("UPDATE_FROM", domain."/edit.php");
define("UPDATE_FROM_SUBMIT", domain."/action/updateaction.php");

define("DELETE_FROM", domain."/action/delete.php");