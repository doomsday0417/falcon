#!/bin/bash
server_ip=$(/sbin/ifconfig -a|grep inet|grep -v 127.0.0.1|grep -v inet6 | awk '{print $2}' | tr -d "addr:")
url='http://128-api.auto.net'

 

#MySQL状态监控TPS
/usr/local/mysql/bin/mysqladmin -uroot -p123456 -r -i 2 extended-status |awk -F "|" 'BEGIN { count=0; }
{ if($2 ~ /Variable_name/ && ++count%15==1)
	{print "----------|---------|--- MySQL Command Status --|----- Innodb row operation -----|-- Buffer Pool Read -----------|- abort_conn-|---Create Tmp files or tables -----|------------ Handler --------------|Innodb pending data|--- table  locks---";
	print "---Time---|---QPS---|select insert update delete|   read inserted updated deleted|   logical    physical---| client conn |tmp_disk_table tmp_files tmp_tables|dele read_key read_rnd update write|fsync  reads  write|lock_imme lock_wait";} 
else if ($2 ~ /Queries/){queries=$3;} 
else if ($2 ~ /Com_select /){com_select=$3;} 
else if ($2 ~ /Com_insert /){com_insert=$3;} 
else if ($2 ~ /Com_update /){com_update=$3;} 
else if ($2 ~ /Com_delete /){com_delete=$3;} 
else if ($2 ~ /Innodb_rows_read/){innodb_rows_read=$3;} 
else if ($2 ~ /Innodb_rows_deleted/){innodb_rows_deleted=$3;} 
else if ($2 ~ /Innodb_rows_inserted/){innodb_rows_inserted=$3;} 
else if ($2 ~ /Innodb_rows_updated/){innodb_rows_updated=$3;} 
else if ($2 ~ /Innodb_buffer_pool_read_requests/){innodb_lor=$3;} 
else if ($2 ~ /Innodb_buffer_pool_reads/){innodb_phr=$3;} 
else if ($2 ~ /Aborted_clients/){client=$3;} 
else if ($2 ~ /Aborted_connects /){conn=$3;} 
else if ($2 ~ /Created_tmp_disk_tables /){tmp_disk_tables=$3;} 
else if ($2 ~ /Created_tmp_files /){tmp_files=$3;} 
else if ($2 ~ /Created_tmp_tables /){tmp_tables=$3;} 
else if ($2 ~ /Handler_delete/){dele=$3;} 
else if ($2 ~ /Handler_read_key/){read_key=$3;} 
else if ($2 ~ /Handler_read_rnd/){read_rnd=$3;} 
else if ($2 ~ /Handler_update/){update=$3;} 
else if ($2 ~ /Handler_write/){write=$3;} 
else if ($2 ~ /Innodb_data_fsyncs/){fsyncs=$3;} 
else if ($2 ~ /Innodb_data_reads/){reads=$3;} 
else if ($2 ~ /Innodb_data_writes/){writes=$3;}
else if ($2 ~ /Table_locks_immediate /){lock_imme=$3;} 
else if ($2 ~ /Table_locks_wait /){lock_wait=$3;} 
else if ($2 ~ /Uptime / && count >= 2)
	{
		
		data = "http://128-api.auto.net/db/?ip=""'$server_ip'"
		data = data"&send_time="strftime("%Y-%m-%d %H:%M:%S")"&select="com_select"&insert="com_insert
		data = data"&update="com_update"&delete="com_delete"&innodb_rows_read="innodb_rows_read
		data = data"&innodb_rows_inserted="innodb_rows_inserted"&innodb_rows_updated="innodb_rows_updated
		data = data"&innodb_rows_deleted="innodb_rows_deleted"&innodb_lor="innodb_lor"&innodb_phr="innodb_phr
		data = data"&client="client"&conn="conn"&tmp_disk_tables="tmp_disk_tables"&tmp_files="tmp_files"&tmp_tables="tmp_tables
		data = data"&handler_delete="dele"&handler_read_key="read_key"&handler_read_rnd="read_rnd"&handler_update="update
		data = data"&handler_write="write"&innodb_data_fsyncs="fsyncs"&innodb_data_reads="reads"&innodb_data_writes="writes
		data = data"&table_locks_immediate="lock_imme"&table_locks_wait="(lock_wait?lock_wait:0)
		
		#data = "'$url'""/db?"data
		#curl -s 'data'
		#print("\""data"\"")
		#a = "\""data"\""
		#print(data)
		print("完成一次")
		curl -s "http://128-api.auto.net/db/?ip=192.168.106.128&send_time=2017-04-01 18:15:45&select= 0           &insert= 0           &update= 0           &delete= 0           &innodb_rows_read= 0           &innodb_rows_inserted= 0           &innodb_rows_updated= 0           &innodb_rows_deleted= 0           &innodb_lor= 0           &innodb_phr= 0           &client= 0           &conn= 0           &tmp_disk_tables= 0           &tmp_files= 0           &tmp_tables= 1           &handler_delete= 0           &handler_read_key= 0           &handler_read_rnd= 342         &handler_update= 0           &handler_write= 341         &innodb_data_fsyncs= 0           &innodb_data_reads= 0           &innodb_data_writes= 0           &table_locks_immediate= 0           &table_locks_wait=0"
		#print("'$url'""/db?"data)
		#printf(" %s |%9d",strftime("%H:%M:%S"),queries);
		#printf("|%6d %6d %6d %6d",com_select,com_insert,com_update,com_delete);
		#printf("|%8d %7d %7d %7d",innodb_rows_read,innodb_rows_inserted,innodb_rows_updated,innodb_rows_deleted);
		#printf("|%10d %11d",innodb_lor,innodb_phr);
		#printf("|%6d %6d",client,conn);
		#printf("|%14d %9d %10d",tmp_disk_tables,tmp_files,tmp_tables); 
		#printf("|%4d %8d %8d %6d %5d",dele,read_key,read_rnd,update,write);
		#printf("|%6d %5d %6d",fsyncs,reads,writes);
		#printf("|%9d %9d\n",lock_imme,lock_wait)
	}
}'
