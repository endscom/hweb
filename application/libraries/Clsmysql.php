<?php
/**
* 
*/
class Clsmysql
{	
	function open_database_connectionMYSQL(){
        $link = mysql_connect('localhost', 'root', '');
        mysql_select_db('bdpavi', $link); 
        return $link;
    }
}
	
?>