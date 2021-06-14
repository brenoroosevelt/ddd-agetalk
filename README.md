# Agetalk - Domain-Driven Design
Exemplos de códgio PHP implementando Domain-Driven Desgin

### Instalação
``` bash
$ git clone https://github.com/brenoroosevelt/ddd-agetalk.git
```
``` bash
$ cd ddd-agetalk
```
``` bash
$ composer update
```
``` bash
$ cd public
$ php -S localhost:8989 public
```
### Endpoints
* `/`: Tela de cadastro 
* `GET` `/alunos`: Lista todos os alunos;  
* `POST` `/alunos` JSON `{nome: '...', 'email': '...'}`: Insere um aluno;
* `DELETE` `/alunos/{id}`: Desativa um aluno.  
