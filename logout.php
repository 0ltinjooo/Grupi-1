<?php
session_start();

// Shkatërro sesionin
session_unset();
session_destroy();

// Ridrejto përdoruesin në faqen e kyçjes
header("Location: index.html");
exit();
?>
