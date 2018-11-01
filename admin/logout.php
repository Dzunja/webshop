<?php
require "../config.php";
User::logout();
header("location: index.html");