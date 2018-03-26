<?php
for ($i = 0 ; $i < 2; $i++ ) {

$pid = pcntl_fork();
	switch ($pid) {
		case -1:
			exit('fork error');

		case 0:
		 	// pcntl_alarm(1);
			echo '子进程';
			exit;
	}

}
$status = null;
pcntl_waitpid(0,$status);
echo $status;
