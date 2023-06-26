<?php 
  function scrub($foo) {
    return htmlspecialchars(stripslashes(trim($foo)));
  }
?>