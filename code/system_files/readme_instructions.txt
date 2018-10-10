>>>> configuring application
1.	download git repository from https://github.com/sinhakgaurav/deliveryorder
	
	sudo mkdir /home/user/projects/
	cd /home/user/projects/
	git clone https://github.com/sinhakgaurav/deliveryorder.git
	git checkout origin master
	sudo chmod -R 777 deliveryorder/*
2.	configuring requirements
	#Copy virtual host file
	sudo cp /home/user/projects/deliveryorder/system_files/deliveryorder.loc.conf /etc/apache2/sites-available/

	#Enable the site as created above
	sudo a2ensite deliveryorder.com.conf

	#Enable mod rewrite
	sudo a2enmod rewrite

	#Restart apache2
	sudo service apache2 restart

	#login in database
	sudo mysql -u {username} -p
	#creating database
	create database deliveryorder;
	
	#get out of mysql
	#importing tables
	mysql -u {username} -p deliveryorder < /home/user/projects/deliveryorder/system_files/deliveryorder.sql
	
3.	changing config
	#go to folder
	cd /home/user/projects/deliveryorder/
	sudo nano app/config/dbConfig.php # give your mysql credentials
	composer install
	




>>>>>>>>>>>>>>all good to go>>>>>>>>>>>>>>>>>>>>>>
	
