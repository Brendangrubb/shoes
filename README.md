# **Shoes**
#### Brendan Grubb, 3/3/2017

&nbsp;
## Description
Shoes is an application created to demonstrate my ability to implement a many to many relationship between tables in a database. With this app the user will be able to create relationships between shoe stores and brands of shoes. The user will be able to add brands and shoes to a database and display which brands are carried at a certain shoe store. They will also be able to see which stores carry a certain brand of shoe.


&nbsp;
## Specifications

### Shoe Store Functionality
|Behavior|Input|Output|
|--------|-----|------|
| The program will add a shoe store to the database | "Shoe Mill" | _same as input_ |
| The program will list all shoe stores saved to the database | _no action necessary, stores listed on home page_ | "List of Stores: Shoe Mill // Foot Traffic" |
| The program will delete all shoe stores saved to the database  |  _user clicks_ "Delete All Shoe Stores" _button_  | "Add Shoe Store Listings to the Database" |
| Program will find a specific shoe store | _user clicks_  "Shoe Mill" | "Shoe Mill -Add brands carried by this store" |
| Program will edit entry of specific shoe store | "Shoe Mill East" | _same as input_ |
| Program will delete entry of specific shoe store | _user clicks delete shoe store_ | "Store has been deleted" |
| Program will list brands carried at a specific shoe store | _user clicks_ "Shoe Mill East" _on home page_ | "Shoe Mill East carries the following shoe brands: -Nike -Puma -Birkenstock -New Balance"

### Shoe Brand Functionality
|Behavior|Input|Output|
|--------|-----|------|
| The program will add a brand to the database | "Nike" | _same as input_ |
| The program will list all brands saved to the database | _no action necessary, shoe brands listed on home page_ | "List of Brands: Nike // Puma" |
| The program will delete all brands saved to the database  |  _user clicks_ "Delete All Brands" _button_  | "Add Brand Listings to the Database" |
| Program will find a specific brand | _user clicks_  "Nike" | "Nike -Add shoe stores that carry this brand" |
| Program will list shoe stores that carry a specific brand | _user clicks_ "Nike" _on home page_ | "Nike is carried at the following stores: -Shoe Mill -Foot Traffic"


&nbsp;
## MySQL commands
*
*
*
*
*
*
*
*
*
*
*
*
*
*
*


&nbsp;
## Setup/Installation Requirements
##### _To view and use this application:_
* It is necessary to download and install a few programs to use this application
    * Go to [getcomposer.org] (https://getcomposer.org/) to download Composer (a dependency manager) for free.
    * If you plan on using this app on a mac, go to [mamp.info] (https://www.mamp.info/en/downloads/) to download MAMP for free. If you're not using a mac, make sure you have software installed that allows you to host a web server via Apache and manage a database via MySQL (WAMP, LAMP, etc)
* Go to my [Github repository] (https://github.com/Brendangrubb/shoes)
* Download the zip file via the green button
* Unzip the file and open the **_shoes-master_** folder
* Inside of the **_shoes-master_** folder, unzip the **_shoes.sql.zip_** file
* Open MAMP (or equivalent) and click on preferences/ports.
    * Make sure that the Apache port number is set to 8888 and the MySQL port number is set to 8889
    * Click start servers.
* Type **_localhost:8888/phpmyadmin_** into your web browser
    * Click the _Import_ tab on the nav bar
    * Click _Choose File_ and navigate to the unzipped **_shoes.sql_**
    * click _GO_
* Open Terminal, navigate to **_shoes-master_** project folder, type **_composer install_** and hit enter
* Navigate Terminal to the **_shoes-master_/web_** folder and set up a server by typing **_php -S localhost:8000_**
* Type **_localhost:8000_** into your web browser
* The application will load and be ready to use!

&nbsp;
## Known Bugs
* No known bugs

&nbsp;
## Technologies Used
* PHP
* Silex
* Twig
* PHPUnit
* SQL
* Apache
* Composer
* Bootstrap
* CSS
* HTML

&nbsp;
_If you have any questions or comments about this program, you can contact me at [brendangrubb@gmail.com](mailto:brendangrubb@gmail.com)._

Copyright (c) 2017 Brendan Grubb

This software is licensed under the GPL license
