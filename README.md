# 🚀 Instruções de Uso

## Para executar e preciso ter o php, laravel e nodejs instalado 

## Rodar o Projeto

1. Instale as dependências:
   ```
   composer install
   ```

2. Configure o arquivo `.env`:
   ```
   cp .env.example .env
   php artisan key:generate
   ```

3. Configure a conexão com o banco de dados no `.env`.

4. O banco de dados usado foi o sqlite eu subi ele junto com o projeto para facilitar os testes

5. Inicie o servidor local:
   ```
   composer run dev
   ```

---

## Rodar os Testes
### Os exercicios 1, 2, 3, 4 foram criados dentro do diretório `App\Utils` e podem ser executados como testes unitários para validação.

Execute os teste com o comando abaixo:

```
php artisan test
```

---

# 📘 API de Veículos

Esta API permite listar, criar, visualizar, atualizar e deletar veículos. Também oferece agregações por marca e ano.

## 🔗 Base URL

```
/api/vehicles
```

---

## 📥 Endpoints

### 1. **Listar veículos**
`GET /api/vehicles`

#### Parâmetros de Query (opcionais):
| Nome     | Tipo   | Descrição                        |
|----------|--------|----------------------------------|
| brand    | string | Filtrar por marca exata          |
| vehicle  | string | Buscar veículo por nome (like)   |
| year     | int    | Filtrar por ano                  |

#### Exemplo de Requisição:
```
GET /api/vehicles?brand=Ford&year=2020
```

#### Exemplo de Resposta:
```json
{
  "vehicles": [
    {
      "id": 1,
      "brand": "Ford",
      "vehicle": "Fiesta",
      "year": 2020,
      "created_at": "...",
      "updated_at": "..."
    }
  ],
  "totalByBrands": [
    { "brand": "Ford", "total": 5 },
    { "brand": "Chevrolet", "total": 3 }
  ],
  "totalByYear": [
    { "year": 2020, "total": 4 },
    { "year": 2021, "total": 2 }
  ]
}
```

---

### 2. **Criar novo veículo**
`POST /api/vehicles`

#### Body (JSON):
```json
{
  "brand": "Ford",
  "vehicle": "Focus",
  "year": 2022
}
```

#### Exemplo de Resposta:
```json
{
  "message": "veiculo criado com sucesso"
}
```

---

### 3. **Visualizar veículo**
`GET /api/vehicles/{id}`

#### Exemplo:
```
GET /api/vehicles/1
```

#### Exemplo de Resposta:
```json
{
  "id": 1,
  "brand": "Ford",
  "vehicle": "Focus",
  "year": 2022,
  "created_at": "...",
  "updated_at": "..."
}
```

---

### 4. **Atualizar veículo**
`PUT /api/vehicles/{id}`

#### Body (JSON):
```json
{
  "brand": "Ford",
  "vehicle": "Fusion",
  "year": 2021
}
```

#### Exemplo de Resposta:
```json
{
  "message": "veiculo atualizado com sucesso"
}
```

---

### 5. **Deletar veículo**
`DELETE /api/vehicles/{id}`

#### Exemplo:
```
DELETE /api/vehicles/1
```

#### Resposta:
```
204 No Content
```

---

## 🛡️ Validações

Os dados enviados no `POST` e `PUT` passam por validação nos Form Requests:

- `StoreVehiclesRequest`
- `UpdateVehiclesRequest`

---

## 📊 Agregações incluídas na listagem

- `totalByBrands`: quantidade de veículos por marca
- `totalByYear`: quantidade de veículos por ano
