### Docker environment blueprint
---
### Services
    - nginx 1.17.6
    - php 7.4.X
    - mysql:8
    - redis

### Build the containers 
`make build`    

### Start the containers 
`make start`    

___
*`http://localhost:PORT` should be available now* (configured in docker-compose.yml)

### Stop the containers 
`make stop`  

### Delete the containers 
`make clean`   
