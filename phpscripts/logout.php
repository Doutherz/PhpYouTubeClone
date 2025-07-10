<?php
session_start();
// remove all session variables
session_unset();

// destroy the session
session_destroy();

//go back to login
header("Location: ../index.php");