# book-app
Test APP for Petabyte
See production here: http://book.gregzorb.info:8080/
Login: user@domain.ltd
Password: teSt#paSSw0rd

### Install ###
* docker-compose up -d
* sudo docker exec -i book_php sh -c "composer install && php vendor/bin/phinx migrate && chmod 0777 -R storage/books/"

# Task 1.
* Upload file in library
* sudo docker exec -i book_php sh -c "php app/Console/console.php process-book"

# Task 2. Archive logs
sudo docker exec -i book_php sh -c "php app/Console/console.php seed-logs && php app/Console/console.php archive-logs"

# Task 3. Register New User
sudo docker exec -i book_php sh -c "php app/Console/console.php add-user username user@domain.ltd teSt#paSSw0rd"
