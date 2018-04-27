### ELevator

## Requirements:
    Docker
    Docker-compose
    Make
    
## How to install
In terminal from the project root run 

    make install

Or

    docker-compose build
    docker-compose up -d
    docker-compose exec php composer install
    
## How to run
In terminal from the project root run

    make go from=3 to=7
  
where `from` - is the floor where you now, 
and `to` - is the floor where you want to go

Or
    
    docker-compose exec php /var/www/index.php 4 2
    
where `4` - is the floor where you now, 
and `2` - is the floor where you want to go


#### NOTE:
Not all functional are implemented yet
No phpunit implemented yet
No YML diagram implemented yet