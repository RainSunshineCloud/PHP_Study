<?php
interface Store
{
	public function storeRequestToken ($parm);

	public function storeAccessToken ($parm);

	public function storeOAuthorizeToken($parm);

	public function getRequestSecret ($parm);

	public function getAccessToken ($parm);

	public function getOAuthorizeToken($parm);
}