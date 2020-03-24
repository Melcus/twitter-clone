FROM mysql:8

ADD conf/start.sh /docker-entrypoint-initdb.d/start.sh
RUN chmod +x /docker-entrypoint-initdb.d/start.sh
ADD conf/mysql-docker.cnf /etc/mysql/mysql.conf.d/z99-docker.cnf
