# Install dependencies:
```
composer install
```

# Create `urls` table:
```SQL
CREATE TABLE `urls` (
	`uniq` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`url` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`visits` INT(11) NOT NULL DEFAULT '0',
	`title` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
```

# Create queue tables:
```
php artisan migrate
```

# Run server:
```
php artisan serve --port=3000
```

# Endpoints:
|method| path | description |
|---|---|---|
|GET| /{uniq} | redirects to url |
|POST| / | Shorts a URL<br />```curl -X 'POST'   'http://localhost:3000/new'   -H 'accept: application/json'   -H 'content-type: application/json'   -d '{"url":"http://google.com"}``` |
|GET| /top100 | Returns the most frequently accessed URLs |
