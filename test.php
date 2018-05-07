<?php
array_reduce([1,2,3],function ($carry,$item) {var_dump($carry);return 1;},function ($item) {var_dump($item);});