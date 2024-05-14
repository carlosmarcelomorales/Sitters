# HOW TO USE

## INSTALLATION

For installing the project correctly use this command from the root of the project:

> make init

Now, the docker of the project is already running and ready to use. You can use

>docker-compose ps

If needed, you can use the commands

>make start / make stop

in order to manage the containers.

The file `reviews.csv` is located inside the `app` folder

## USAGE

First, we will need to enter inside the php container to be able to execute our command. To do so, we will use the next commadn:

>make interactive

Now we are already inside the shell. 

To run our command we will need to use:

>php bin/console app:generate-ranking-sitters

This will execute the command, and when it finshes, we will see the message: `Ranking of sitters was successfully created!!!`

Then inside our `app` folder it will appear the file `sitters.csv`.

## How to test?

Go inside of the shell using

>make interactive

And run the next line:

> php bin/phpunit

Then all the test will execute.