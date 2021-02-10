Requirements:

- PHP 7.4
- MySQL 5.6
- Composer

Installation instructions:

1. Change the values for DB connection in .env if necessary. Here are the defaulted inputs.

DEFAULT_DB_ENGINE=mysql
DEFAULT_DB_HOST=insite-interviewing-db-do-user-1938513-0.b.db.ondigitalocean.com
DEFAULT_DB_PORT=25060
DEFAULT_DB_NAME=directory
DEFAULT_DB_USER=testuser
DEFAULT_DB_PASSWORD=bghnla2ecy60aph6
DEFAULT_DB_SERVER_VERSION=0

2. I've added a fixture for user. You can run 'php bin/console doctrine:fixtures:load --append' but my access won't allow me to add a user in the directory.

Login credentials for that will be (If successfully load fixtures)

Email: mjmconvento@gmail.com
Password: password
api_key: api_key_12345

3. You can run symfony built-in server by typing in the command line 'symfony server:start'.

4. Homepage will redirect to '/login'. You can use the credentials in step 2. This will redirect you to the secured page with categories and products on a table. You can choose to load the initial data by adding query 'tenant' like '/secured_page?tenant=Tenant One' or '/secured_page?tenant=Tenant two'. I would like to use 'id' or 'tenant_db' field for cleaner inputs but section 4.1 says that it should be name. 


Using API:
-  You can access the api of getting products by using Postman and accessing GET method '/api/get_products?tenant=Tenant One' or '/api/get_products?tenant=Tenant Two'. In headers, use key "X-AUTH-TOKEN" and value is "api_key_12345" (If fixtures were loaded).

Product Add Page:
- You can create a product by accessing '/product/create'.

Unit Test:
- You can run some simple test cases by running './vendor/bin/simple-phpunit' in the command line.

Logging out:
- You can logout by accessing '/logout' manually

