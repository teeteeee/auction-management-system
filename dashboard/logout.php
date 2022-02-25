<?php

require_once '../config.php';

session_destroy();

header('location: ' . ROOT . '/auth/login.php');