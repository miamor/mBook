<?php
$uid = $config->get('u');
echo ($config->follow($uid)) ? 1 : 0;
