php_sqlsrv_adapter
==================

Adapter for legacy code (which uses mssql_ * functions) to work with the php_sqlsrv driver

Usage:
------------------

* Get [official Microsoft Drivers for PHP for SQL Server](http://www.microsoft.com/en-us/download/details.aspx?id=20098) or (recommended) [unofficial but easy to use](https://skydrive.live.com/?cid=669ee24817961774&id=669EE24817961774%21146) (description [here](http://robsphp.blogspot.ru/2012/06/unofficial-microsoft-sql-server-driver.html))
* add extension in php.ini (ex. extension=php_sqlsrv_54_ts_unofficial.dll)
* include sqlsrv-adapter.php before your legacy code (use auto_prepend_file = /path/to/sqlsrv-adapter.php for transparent migration)
* profit!
 
Known issues/limitations:
------------------

* query which affected more than one resultsets without NOCOUNT option always return false (add SET NOCOUNT ON in your querys)
* init/bind/execute functions not implemented (use mssql_query)

