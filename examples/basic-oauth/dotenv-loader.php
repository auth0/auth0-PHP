<?php
  // Read .env
  try {
    Dotenv::load(__DIR__);
  } catch(InvalidArgumentException $ex) {
    // Ignore if no dotenv
  }








