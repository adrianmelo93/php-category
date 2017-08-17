<?php

//show error report
  error_reporting(E_ALL);

  //set your default timezone
  date_default_timezone_set('America/New_York');

  $page = isset($_GET['page']) ? $_GET['page'] : 1;
