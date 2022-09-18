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
	public $user='xxxxxxxxxxxxxx';
	public $pass='xxxxxxxxxxxxxx';
	public $dbn='admin_casino_bot';
}