<?php

define("SERVER", "http://localhost/" );

define("FOLDER", "todolist/Image-and-Crud/");

define("DOMAIN", SERVER.FOLDER);

//  C:\xammp\hdocs
define("SERVER2", $_SERVER['DOCUMENT_ROOT']);
define("DOMAIN2", SERVER2.FOLDER);

define("DASHBOARD", DOMAIN."dashboard.php");

define("INSERT_FORM", DOMAIN."action/form-action.php");

define("EDIT_FORM", DOMAIN."edit.php");
define("UPDATE_FROM", DOMAIN."action/formupdate.php");

define("DELETE_FORM", DOMAIN."action/delete.php");
