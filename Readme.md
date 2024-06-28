# Hosting A Web
### XAMPP
#### Install a Web Server
- Visit Apache Friends and download XAMPP installer[1].
- Install XAMPP
- After the installation, solve errors if necessary (such as port conflict, access control problems, etc)

#### Host a Website 
- Locate the `htdocs` directory. `e.g. C:/xampp/htdocs`
- Create a project directory `e.g. C:/xampp/htdocs/<proj_name>`
- Move website files inside that project directory
- Start XAMPP
- Start the Apache server by clicking the `Start` button next to `Apache`
- Navigate to your website: ```http://localhost:<your_port>/<proj_name>```

#### Run a Database Server
- By default, XAMPP already includes the SQL Server `phpMyAdmin`
- Start XAMPP
- Start the SQL Server by clicking the `Start` button next to `MySQL`
- Navigate to `phpMyAdmin`: ```http://localhost:<your_port>/phpmyadmin/```
- SQL statement example
```SQL
CREATE TABLE IF NOT EXISTS `accounts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`username` varchar(50) NOT NULL,
  	`password` varchar(255) NOT NULL,
  	`email` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `accounts` (`id`, `username`, `password`, `email`) VALUES (1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com');
```



# Reference
1. https://www.geeksforgeeks.org/how-to-install-xampp-on-windows/
2. 

# Useful Websites
1. [Secure Login System with PHP and MySQL](ttps://codeshack.io/secure-login-system-php-mysql/)
2. 