<?php
$date1 = date_create('2017-01-02 02:02:02');
$date2 = date_create('2017-01-05 01:01:01');
var_dump(date_diff($date1,$date2)->format('s'));
