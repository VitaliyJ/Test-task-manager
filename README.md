## Документация к API

- Пример ответа при возникновении ошибки
```json
"errors": {
        "name": [
            "The name field is required."
        ]
}

// errors - array|string - сообщение об ошибке, либо массив 
// с сообщениями, где ключ - название параметра, который не прошел 
// валидацию
```

- Получить список задач
> - url - `/api/tasks`
> - HTTP method - `GET`
> - parameters: <br>
> `completed` - integer [0..1] - необязательный, `0` - список только невыполненных задач; `1` - список только выполненных задач; `любое другое значение, либо отсутствие параметра` - получить все задачи
> - response example:
```json
"data": [
{
    "id": 2,
    "name": "Задача №2",
    "completed": 0, // 0 - не выполнено; 1 - выполнено
    "created_at": "2021-03-31T21:39:54.000000Z",
    "updated_at": "2021-03-31T21:39:54.000000Z"
},
{
    "id": 1,
    "name": "Задача №1",
    "completed": 1, // 0 - не выполнено; 1 - выполнено
    "created_at": "2021-03-31T21:38:48.000000Z",
    "updated_at": "2021-03-31T21:38:48.000000Z"
},
...
```

- Добавить новую задачу
> - url - `/api/tasks/`
> - HTTP method - `POST`
> - parameters: <br>
> `name` - string - обязательный, название задачи
> - response example: <br>
```json
"data": {
    "name": "Название задачи",
    "completed": 0, // 0 - не выполнено; 1 - выполнено
    "updated_at": "2021-04-01T08:09:24.000000Z",
    "created_at": "2021-04-01T08:09:24.000000Z",
    "id": 9
}
```

- Редактировать задачу
> - url - `/api/tasks/{id}`
> - HTTP method - `PUT`/`PATCH`
> - parameters: <br>
> `name` - string - обязательный, название задачи
> - response example: <br>
```json
"data": {
    "name": "Обновлённое название задачи",
    "completed": 0, // 0 - не выполнено; 1 - выполнено
    "updated_at": "2021-04-01T08:09:24.000000Z",
    "created_at": "2021-04-01T08:10:30.000000Z",
    "id": 9
}
```

- Удаление задачи (удалить можно только выполненную задачу)
> - url - `/api/tasks/{id}`
> - HTTP method - `DELETE`
> - response example: <br>
```json
"data": {
  "success": true
}
``` 

- Проставление флага выполнено/не выполнено
> - url - `/api/tasks/{id}/complete`
> - HTTP method - `PUT`/`PATCH`
> - parameters: <br>
> `completed` - integer [0..1] - обязательный, 0 - не выполнено; 1 - выполнено
> - response example: <br>
```json
"data": {
    "name": "Обновлённое название задачи",
    "completed": 1, // 0 - не выполнено; 1 - выполнено
    "updated_at": "2021-04-01T08:09:24.000000Z",
    "created_at": "2021-04-01T08:10:31.000000Z",
    "id": 9
}
```
