"Ourtube"
============

Web service for watching youtube videos together online.


Documentation and guides
----------------

User guide can be found [here](https://github.com/EvgenyNasretdinov/ourtube/blob/master/txt/userguide.md)

And simple description of how the app works is [here](https://github.com/EvgenyNasretdinov/ourtube/blob/master/txt/programmerguide.md)

[Specification](https://github.com/EvgenyNasretdinov/ourtube/blob/master/txt/specification.md)

License
-------

Code is licensed under Apache License, Version 2.0.


Local execution
---------

If you want to use this app on your local computer,
you should run:

    git clone https://github.com/EvgenyNasretdinov/ourtube

    cd ourtube

    composer install

    php artisan migrate

    php artisan serve

also you will need to change your database settings in your .env file, and configure pusher authentication here.