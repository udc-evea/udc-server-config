<?php
  global $INDEX;
  if(!isset($INDEX))
  {
    header("Location: /status");
    die();
  }