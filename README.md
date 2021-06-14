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
* `/`: tela de cadastro; 
* `GET` `/alunos`: lista todos os alunos;  
* `POST` `/alunos` JSON `{nome: '...', 'email': '...'}`: insere um aluno;
* `DELETE` `/alunos/{id}`: desativa um aluno.  
