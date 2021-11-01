
## PHP Test 

In `fetch_and_redact.php`, curl is used to accomplish the tasks. A simple function named `curl()`, is used to fetch
 the data from the file and later write the modified contents from the file to another json file. 
 
 `query.php` holds the two methods to run and test the queries to search in the finalized json data, and generate the
  report later. 

## MYSQL Test

Since there was no restriction in using any third party library as in the PHP test, I've used illuminate\database
 library for
 mysql queries
, since the project is
 going to be on
 Laravel. A `bootstrap
.php` is used for DB connection.

Also, I've created a `Models` directory for all the tables models for Eloquent queries. 

All the queries, as per my understanding, are in `index-mysql.php` file with clear comments on what each query
 does as per the instructions.

Note. You need to run `composer install` in the project root directory to autoload models classes and install
 dependencies.


#### In `helpers.php`, a `DD()` mehod was setup so that I don't have to print_r and die, again and again.
