# Contribution guidelines

## Creating pull request
1. Open a related issue in the [Issue Tracker](https://github.com/functional-php/fantasy-land/issues)
2. Fork repository on Web Page
3. Clone this repository `git clone https://github.com/{your-username}/fantasy-land`
4. Create a branch with expressive name `git checkout -b {your-username}-{what-i-am-going-to-develop}`
5. Commit your changes `git commit -m "{your-username} This is what i did"`
6. Push your changes `git push origin {your-username}-{what-i-am-going-to-develop}`
7. Create a Pull Request to master on Web Page

## Code style
Code style rules are defined and automated via [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) 
to automatically apply them to code base please run:
```
composer fix
```

`functional-php/fantasy-land` follows the PSR-4 autoloading standard.
