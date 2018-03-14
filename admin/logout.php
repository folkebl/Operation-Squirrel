<?php

Session_start();
session_destroy();
session_regenerate_id(TRUE);
header("location:../index.html");