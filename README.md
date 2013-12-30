MindParadise
==============

心灵伊甸园网站

# Mind Paradise Develop Environment setup (for ubuntu 12.04 LTS)

## Before Install

### update your aptitude sources list
search a sources list on web browser, I recommend the neteasy mirror sources list.
then execute the command :

	sudo gedit /etc/apt/sources.list

then rewrite the content of the file sources.list with what your have search from the Internet


### install Apache2 
excute the command:

	sudo apt-get install apache2


### install MySQL
excute the command:

	sudo apt-get install mysql-server mysql-client

the set your mysql root password


### install php5 and Apache PHP5 module
excute the command:
	
	sudo apt-get install php5 libapache2-mod-php5

then restart the apache2 server,excute the command:

	sudo /etc/init.d/apache2 restart


### let Apahce2 and PHP5 suport MySQL
excute the command:

	sudo apt-get install libapache2-mod-auth-mysql
	sudo apt-get install php5-mysql

then restart the apache2 server,excute the command:

	sudo /etc/init.d/apache2 restart

a more greatful method is : 

	sudo apachectl graceful;

### install git 
excute the command:

	sudo apt-get install git git-core

## Install

### install mindparadise

#### first clone the repo:

	git clone git@github.com:nwpu-graduation-project/MindParadise.git ~/mindparadise/

#### next configure apache2:

##### Make sure you are loading up mod_rewrite correctly.
You should see something like:"LoadModule rewrite_module libexec/apache2/mod_rewrite.so", which is in the file /etc/apache2/mod-available/rewirte.load. However,the apache2 do not load the rewrite module,so you should load it.To make a symbolic link, execute the command:

	cd /etc/apache2/mods-enables;
	sudo ln -s ../mods-available/rewrite.load;

Or execute the command to achieve the same effect:
	
	sudo a2enmod rewrite;

##### let apache2 can write things to directory install-path/app/tmp (you should create it), execute the command:

	sudo chgrp -R www-data app/tmp;
	chmod -R 774 app/tmp;

##### you must change your VirtualHost attribute DocumentRoot to 'install-path/app/webroot'.
And make sure that an .htaccess override is allowed and that AllowOverride is set to All for the correct DocumentRoot. You should see something similar to:(change the virtualhost of apache2, which define in the file /etc/apahce2/sites-enabled/000-default or file /etc/apache2/httpd.conf)

you can make it in 2 ways below:
###### you can modify the file /etc/apahce2/sites-enabled/000-default like this.

	<VirtualHost *:80>
		ServerAdmin webmaster@localhost

		DocumentRoot /home/xxxxx/projects/mindparadise/app/webroot
		<Directory />
		Options FollowSymLinks
		AllowOverride All
		</Directory>
		<Directory /www/var>
			Options Indexes FollowSymLinks MultiViews
			AllowOverride None
			Order allow,deny
			allow from all
		</Directory>

		ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
		<Directory "/usr/lib/cgi-bin">
			AllowOverride None
			Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
			Order allow,deny
			Allow from all
		</Directory>

		ErrorLog ${APACHE_LOG_DIR}/error.log

		# Possible values include: debug, info, notice, warn, error, crit,
		# alert, emerg.
		LogLevel warn

		CustomLog ${APACHE_LOG_DIR}/access.log combined

		Alias /doc/ "/usr/share/doc/"
		<Directory "/usr/share/doc/">
			Options Indexes MultiViews FollowSymLinks
			AllowOverride None
			Order deny,allow
			Deny from all
			Allow from 127.0.0.0/255.0.0.0 ::1/128
		</Directory>
	</VirtualHost>

	(attend to change the home directory xxxxx into your own directory)
###### another way to acheive it is that you can make your own new virtual host.
fisrt run command to configure a hosts in your system:

	sudo vim /etc/hosts;
	
then add an new line :' 127.0.0.1 mindparadise.com' into the file, content seems like this

	127.0.0.1	localhost
	127.0.0.1	mindparadise.com
	127.0.1.1	tahong-laptop
	
next open run command to create a new virtual host:

	sudo vim /etc/aptache2/httpd.conf;
	
then paste the content below into the the file:

	<VirtualHost *:80>
		ServerAdmin webmaster@localhost
		ServerName mindparadise.com
		DocumentRoot /home/xxxxx/projects/mindparadise/app/webroot
		<Directory /home/xxxxx/projects/mindparadise/app/webroot>
			Options Indexes FollowSymLinks MultiViews
			AllowOverride All
			Order allow,deny
			allow from all
		</Directory>
	</VirtualHost>

(attend to change the home directory xxxxx into your own directory. I have a test then find out that if you don't write the block '<Directory></Directory>' you got the same effect,I guesss the system have set 'AllowOverride' to 'All' by default )



#### configure the cakephp database
create the file database.php in the directory: app/config/ by excuting 

	cp database.php.default database.php
then, change the configure of the database settings as follow:

	class DATABASE_CONFIG {
		public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'xxxx',
		'password' => 'xxxxx',
		'database' => 'xxx_xxxx',
		'prefix' => '',
		'encoding' => 'utf8',
		);
	}

remmber to change the login, password and database field;

#### configure the email server
In order to achieve the recover and verify function, we need a email server. we choose gmail sever as our email sever:
First, login your gmail account,then go 'settings'->'settings'->'Forwarding and POP/IAMP'->'POP Download', then enable the 'Enable POP for mail that arrives from now on', then save settings.
Second, create the file email.php in the directory: app/config by excuting
	cp email.php.default email.php
then, overide the content as follow:

	class EmailConfig 
	{
		public $default = array(
		'host' => 'ssl://smtp.gmail.com',
		'port' => 465,
		'username' => 'xxxxxx@gmail.com',
		'password' => 'xxxxxxxxxx',
		'timeout' => 30,
		'transport' => 'Smtp',

		);
	}

do not forget to change the username and password field;


ok,your development enviroment setup ok:open the browser,input the url :mindparadise.com,Enter.



