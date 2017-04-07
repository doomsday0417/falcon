#!/bin/bash
server_ip=$(/sbin/ifconfig -a|grep inet|grep -v 127.0.0.1|grep -v inet6 | awk '{print $2}' | tr -d "addr:")
url='http://128-api.auto.net'

 

/usr/local/mysql/bin/mysqladmin -uroot -p123456 -i 2 extended-status |awk -F "|" 'BEGIN { count=0; } 
{ if($2 ~ /Variable_name/ && ++count%15==1)
	{print "---------|------------Threads----------|--------max_used--------";    
	 print "---Time--|th_cach th_conn th_crt th_run|used_conn conn_time     ";}  
else if ($2 ~ /Threads_cached /){th_cach=$3;} 
else if ($2 ~ /Threads_connected /){th_conn=$3;} 
else if ($2 ~ /Threads_created /){th_crt=$3;} 
else if ($2 ~ /Threads_running /){th_run=$3;} 
else if ($2 ~ /Max_used_connections /){used_conn=$3;}
else if ($2 ~ /Max_used_connections_time /){conn_time=$3;}
else if ($2 ~ /Uptime / && count >= 2)
	{
	
	data = "'$url'""/db/thread/?ip=""'$server_ip'"
	data = data"&send_time="strftime("%Y-%m-%d %H:%M:%S")"&th_cach="th_cach"&th_conn="th_conn"&th_created="th_crt
	data = data"&th_running="th_run"&used_conn="used_conn
	#print(data)
	cmd = "curl -s ""\"" data "\""
		
    system(cmd)
	#printf(" %s",strftime("%H:%M:%S"));
	#printf("|%7d %7d %6d %6d",th_cach,th_conn,th_crt,th_run);
	#printf("|%9d %s\n",used_conn,conn_time)
	}
}'
