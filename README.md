# book-app
Test APP for Petabyte
See production here: http://book.gregzorb.info:8080/

### Install ###
* docker-compose up -d
* sudo docker exec -i book_php sh -c "composer install && php vendor/bin/phinx migrate && chmod 0777 -R storage/books/"

# Register New User
sudo docker exec -i book_php sh -c "php app/Console/console.php add-user username email@domain.ltd testpassword"