# book-app
Test APP for Petabyte
See production here: http://book.gregzorb.info:8080/

### Migrations ###

* Migrations:
php vendor/bin/phinx create MyMigration
php vendor/bin/phinx migrate
php vendor/bin/phinx rollback


# Register New User
sudo docker exec -i book_php sh -c "php app/Console/console.php add-user username email@domain.ltd testpassword"