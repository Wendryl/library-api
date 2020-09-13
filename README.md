# library-api
A library PHP REST API built with slim framework
## Installation & Usage
``$ git clone https://github.com/Wendryl/library-api``  
``$ cd library-api``  
``$ composer install``  
``$ mysql -u username -p -h localhost library < library.sql``  
``$ php -S localhost:3000 -t public``  

## Routes
**GET**    /books      -> **Show all** books  
**POST**   /books      -> **Create** Book   
**GET**    /books/{id} -> **Show** book data **by id**  
**PUT**    /books/{id} -> **Update** book data   
**DELETE** /books/{id} -> **Delete** book  
