**Open-source Research Interest Network (ORIENT)**
Copyright (c) 2018 Nathan Brown, Elias Nyantakanya, Anthony Todaro, Brad Hamilton and Christian Westbrook

1. INTRODUCTION

ORIENT is an open-source social network designed with research in mind. Users can create a profile of their skills and research interests and find other users with similar interests.

2. LICENSE

This web system is licensed as open-source under the MIT license. Under this license anyone may use, modify, merge, distribute, sublicense, and/or sell copies of this web system, provided that the same license is included with any and all copies or substantial portions of the system.

3. INITIAL SETUP

    1. Set up a Linux environment with internet access.

        Common Linux Distributions
        Ubuntu   : https://www.ubuntu.com/
        openSUSE : https://www.opensuse.org/

    2. Install the following services and technologies
    Apache HTTP Server : https://httpd.apache.org/
    PHP                : http://www.php.net/
    Git                : https://git-scm.com/
    MariaDB            : https://mariadb.org/
  
    3. Clone the ORIENT repository into your Linux environment.
    git clone https://github.com/christian-westbrook/orient.git
  
    4. Replace the root server directory of your Apache HTTP Server with the public_html directory in the ORIENT repository. Be sure to change the name of the public_html directory back to the proper name for your root server directory (usually either 'htdocs' or 'www').
  
    5. Set up an administrator account with MariaDB.
  
    6. Make a new database/schema for ORIENT within MariaDB.
  
    7. Change the variables in the ./public_html/php/database.php script such that the host, username, password, and dbname variables reference the database you intend to use for ORIENT and the MariaDB username and password through which the ORIENT web system will access and modify the database.
  
    8. Run the script ./public_html/sql/build.sql on the database created for ORIENT.
  
    9. Navigate to your web server's index page.
  
    10. Log in with the credentials:
    email = admin@admin.com
    password = password
  
    11. CHANGE YOUR EMAIL AND PASSWORD
  
    12. Invite other users to sign up on your ORIENT server.
  
    13. Change the roles and settings of your ORIENT members with the admin tools page.
