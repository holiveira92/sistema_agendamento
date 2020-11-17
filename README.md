Sistema hospedado na AWS EC2: http://ec2-18-231-167-244.sa-east-1.compute.amazonaws.com/

Passos a rodar:
* Clonar repo
* Verificar se depenências estão habilitadas e instaladas
* yarn install
* composer install ou composer update
* php artisan key:generate
* cp .env.example .env
* php artisan key:generate
* php artisan migrate
* yarn run dev
* php artisan serve


Exemplo AWS: Endpoint para API de Médicos para aplicativo de celular:<br><br>

Obs.: Enviar Headers: <br>
Accept => application/json<br>

GET Lista: http://ec2-18-231-167-244.sa-east-1.compute.amazonaws.com/api/medico <br>
GET recurso específico: http://ec2-18-231-167-244.sa-east-1.compute.amazonaws.com/api/medico/{ID} <br>
DELETE recurso: http://ec2-18-231-167-244.sa-east-1.compute.amazonaws.com/api/medico/{ID} <br>
POST recurso: http://ec2-18-231-167-244.sa-east-1.compute.amazonaws.com/api/medico/ <br>
body: <br>
{   "nome": "Dr. Nome do Médico", 
    "sexo": "Masculino",
    "data_nascimento": "1992-01-01",
    "especialidades": "pediatria",
    "celular": "31988889999",
    "cpf_cnpj": "546.722.488-36",
    "crm": "CRM 123456789",
    "endereco": "Rua XXXXX, Bairro YYYY, Nº123, AP508",
    "cidade": "Belo Horizonte",
    "cep": "12345678910"
}
<br>
PUT recurso: http://ec2-18-231-167-244.sa-east-1.compute.amazonaws.com/api/medico/{ID} <br>
body: <br>
{
    "nome": "Dr. Nome do Médico",
    "sexo": "Masculino",
    "data_nascimento": "1992-01-01",
    "especialidades": "pediatria",
    "celular": "31988889999",
    "cpf_cnpj": "546.722.488-36",
    "crm": "CRM 123456789",
    "endereco": "Rua XXXXX, Bairro YYYY, Nº123, AP508",
    "cidade": "Belo Horizonte",
    "cep": "12345678910"
}
