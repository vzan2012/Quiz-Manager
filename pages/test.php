<?php
require("../model/DB.php");
$db = DB::getConnection();
print ($db == null) ? 'sorry' : 'works';
