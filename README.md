# Fortissimo CLI
This project provides additional components to aide in the creation of CLI (console) applications with [Fortissimo](https://github.com/Masterminds/Fortissimo).

## Components
There are a number of useful components and commands included covering a runtime, [Phar](http://php.net/manual/en/book.phar.php) file manipulation, and I/O.

### Runtime
Fortissimo executes within a runtime and there are difference ones for the web, CLI, or if you want to write a custom one. The runtime provided here is designed to work with CLI applications and does some work for you. For example, it sets up input and output utilities on the execution context.

### Phar files
When creating CLI applications or scripts you want to share Phar files are a great way to package an entire project into a single file. The compiler included here is designed to help create a Phar file from the contents of a Fortissimo project.

### I/O (input/output)
Dealing with I/O is entirely different on the CLI and on the web. The I/O components include basic I/O functionality. At the moments these are wrappers around the Symfony Console I/O.

## Fortissimo CLI Base
While components are great, to speed up application development there is also a skeleton project called [Fortissimo CLI Base](https://github.com/Masterminds/Fortissimo-CLI-Base). This project uses Fortissimo CLI and provides tools and an environment to get started.

## License
Fortissimo CLI is licensed under the MIT license.