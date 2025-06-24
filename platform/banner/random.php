<?php
$files = glob('*.htm*');
$random_file = $files[array_rand($files)];
include($random_file);