<?php


class SqlBot 
{
	public function __construct()
	{
	}
	
	public function __destruct()
	{
        gc_collect_cycles();
    }
	
	public $host='127.0.0.1';
	public $user='xxxxxxxxxx';
	public $pass='xxxxxxxxxxxx';
	public $dbn='admin_casino_bot';
}