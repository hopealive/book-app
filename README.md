# book-app
Test APP for Petabyte
See production here: http://book.gregzorb.info:8080/
Login: user@domain.ltd
Password: teSt#paSSw0rd

### Requirements ###
* Ubuntu > 16.04
* Docker >= 19.03
* Docker Compose >= 1.17

### Install ###
* docker-compose up -d
* sudo docker exec -i book_php sh -c "composer install && php vendor/bin/phinx migrate && chmod 0777 -R storage/books/"
* add to cron new items:
* * * * * docker exec -i book_php sh -c "php app/Console/console.php process-book"
* * * * * docker exec -i book_php sh -c "php app/Console/console.php archive-logs"

### Tasks ###
# Task 1. Process New Book
* Upload file in library
* sudo docker exec -i book_php sh -c "php app/Console/console.php process-book"

# Task 2. Archive Logs
sudo docker exec -i book_php sh -c "php app/Console/console.php seed-logs && php app/Console/console.php archive-logs"

# Task 3. Register New User
sudo docker exec -i book_php sh -c "php app/Console/console.php add-user username user@domain.ltd teSt#paSSw0rd"
