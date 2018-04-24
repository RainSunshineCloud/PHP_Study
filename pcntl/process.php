<?php

//信号的使用机制是只有当信号发生后才有用。在alarm等待过程中，如果pentl_signal_dispatch已经跳过，也不会执行回调函数
//同时alarm也并没有像文档说明的每隔一段时间就发送一次信号
//使用中：alarm是调用器，signal是注册器，dispatch是声明器
//posix_kill是向进程发送信号
for ($i = 0 ; $i < 2; $i++ ) {

$pid = pcntl_fork();
	switch ($pid) {
		case -1:
			exit('fork error');

		case 0:

		 	
		 	pcntl_signal(SIGALRM,'echo_me');
		 	pcntl_signal(SIGTERM,'echo_you');
		 	for ($j = 0; $j < 3; $j++) {
		 		pcntl_alarm(1);
		 		sleep(4);
				echo '子进程'."\n";
				posix_kill(posix_getpid(),SIGTERM);
			 		
		 	}	
		 	pcntl_signal_dispatch();
			 	
			exit;
	}

}
$status = null;
pcntl_waitpid(0,$status);


function echo_me($sig)
{
	echo posix_getpid()."\n";
}

function echo_you($sig)
{
	echo $sig.'23'."\n";
}