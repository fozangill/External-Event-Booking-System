<?php

$conn = mysqli_connect('localhost', 'root', '', 'events');

if($conn === false) {
    die("Error: Could not connect " . mysqli_connect_error());
}

