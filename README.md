# My Virtual Pizza House
A space to explore modular asynchrony in PHP   
...on the example of a pizza house.

## Kickstart
```shell
make up
make console

# inside console
composer install
```

## Start the machinery
### Option 1
```shell
# inside 1th docker console
./bin/console messenger:consume order_manager_transport menu_transport waiter_transport kitchen_transport

# inside 2nd docker console
./bin/console app:waiter:start TBL1
```
Nothing spectacular, but... it works!

### Option 2
```shell
# inside 1th docker console
./bin/console messenger:consume order_manager_transport
# inside 2nd docker console
./bin/console messenger:consume menu_transport
# inside 3rd docker console
./bin/console messenger:consume waiter_transport
# inside 4th docker console
./bin/console messenger:consume kitchen_transport

# inside 5nd docker console
./bin/console app:waiter:start TableId
```

You can watch RabbitMQ queues: http://localhost:1567 (user/user)

## Tests
Inside console
```shell
make tests-unit
make tests-coverage
make tests-mutation # see var/infection-logs.html
```
...I know there's still a lot to do here ;)

## Tools
Inside console
#### Rector instantly upgrades and refactors the PHP code of your application
https://github.com/rectorphp/rector
```shell
make rector
```

## Heavy tasks
```shell
# inside 1th docker console
./bin/console messenger:consume heavy_worker_transport
# inside 2nd docker console

# find consumer PID
ps aux |grep messenger:consume
# start heavy command
./bin/console app:heavy-worker:start
# kill consumer
kill consumer_pid
```

