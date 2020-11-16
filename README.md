# Bloganza

An experiment exploring how to implement a blog with Domain Driven Design in PHP.

## Installation

1. Rename `Settings.sample.php` to `Settings.php` in the folder `app/Config` and fill out the appropriate fields in the file.
2. `index.php` should be placed in the webroot and point to the applications bootstrap file. In this case it is assumed that the webroot is the folder `public` and the application is outside the webroot.
3. Create a database with the following schema:

```
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` VALUES (1,'first-post','First post','<h1>First post</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'),(2,'second-post','Second post','<h1>Second post</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>');
```

## TODO

- Rework bootstrapping and autoloading. Right now it is only meant to test if the application works.
- Setup routing for all posts, single posts and pretty URLs.
- Implement control panel for creating new posts.
- Create tests with  e.g. `PHPUnit`, `phpspec`, `Behat` and `Codeception`.
- Implement return type declarations and scalar type declarations properly.
- Add comments where appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
