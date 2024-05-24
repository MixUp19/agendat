<?php
    session_start();
    if(!isset($_SESSION['AlmID'])){
      header("Location: index.html");
    }