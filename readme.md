
**Requirements:**
- php 7.2
- Apache webserver
- Mcrypt (PHP ext)



**Installation**:

First run bellow commands in your terminal:

`composer install`

`php artisan serv`



**Then open the following url:**

`http://localhost:8000/api/v_1_0/en/weather/Amsterdam?degree_type=celsius&date=2019-12-25`

-------------------------------

**Notes:**
- I used fileCache for caching data during period of time

- The test coverage statistics can accessable in the following address:

`project_path/tests/_reports/coverage/index.html`

- for running unit tests you can run following command:
`php ./vendor/bin/phpunit `