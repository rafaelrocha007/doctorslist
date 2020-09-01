# DoctorsList

Listagem e criação de uma lista de médicos e suas especialidades através de uma API REST segurada por JWT.

## Backend
Backend baseado em Laravel 7.x, MySQL 5.7 e PHP 7.3.
Ambiente de desenvolvimento baseado em containers docker https://hub.docker.com/r/rafaelrocha007/laravel

## Frontend

## Instruções e requisitos

Para rodar em ambiente de desenvolvimento é necessário instalar o docker e docker-compose, feito isso, basta seguir os passos:

Clonar o projeto  
IMPORTANTE: caso esteja usando Windows, cuide para que os arquivos do projeto estejam com a quebra de linha LF (\n) pois a quebra de linha padrão no Windows é CRLF (\r\n) o que causa interrupção de execução do entrypoint no container.

    git clone https://github.com/rafaelrocha007/doctors.git meu-projeto

    cd meu-projeto
    
Variáveis de ambiente pré-configuradas, mas podem ser alteradas caso necessário
 
    cp .env.example .env      
    
Nova cópia para a pasta .docker/app necessária para ser usada no template do dockerize

    cp .env .docker/app/.env  

    docker-compose up --build

Com os containers rodando o frontend ficará disponível em http://localhost:8000 e a API ficará disponível em http://localhost:8000/api 

Faça a carga inicial de dados de usuários (users) e tabela de especialidades (specialties)

    php artisan db:seed

O login padrão é __admin@email.com__ com a senha __123456__

## Screenshots 

![Login form](https://github.com/rafaelrocha007/doctorslist/blob/master/screenshots/DoctorsList-login.png?raw=true)  
Formulário de login  

![Edit form](https://github.com/rafaelrocha007/doctorslist/blob/master/screenshots/DoctorsList-empty-search-or-resultset.png?raw=true)  
Pesquisa vazia ou banco de dados vazio   

![Edit form](https://github.com/rafaelrocha007/doctorslist/blob/master/screenshots/DoctorsList-search-results.png?raw=true)  
Resultado da pesquisa (inicia-se com todos os resultados caso haja registros salvos)  

![Edit form](https://github.com/rafaelrocha007/doctorslist/blob/master/screenshots/DoctorsList-new-form.png?raw=true)  
Novo registro  
  
![Edit form](https://github.com/rafaelrocha007/doctorslist/blob/master/screenshots/DoctorsList-edit-form.png?raw=true)  
Editando registro  
