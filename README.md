# Как работать с Query builder
***

В файле с модулем контроллера пишем:
### $this -> db -> queryBuilder(...);
Без указания типа запроса ничего не сработает
Поэтому на месте троеточия нужно поставить на выбор:
###### select, insert, delete, update
***

### select
##### $this -> db -> queryBuilder('select') -> select('*') -> from('users') -> where(['id' => 5]);
Если в where необходимо добавить несколько параметров(AND, OR), то запрос будет выглядить так:
$this -> db -> queryBuilder('select') -> select('*') -> from('users') -> where([['id' => 5], ['OR'], ['email' => 'test@gmail.com']]);
***

### update

##### $this -> db -> queryBuilder('update') -> table('users') -> set(['id' => 5]) -> where(['id' => 8]);
Множество параметров
##### $this -> db -> queryBuilder('update') -> table('users') -> set([['id' => 5], ['email' => 'test@yandex.ru']]) -> where([['id' => 8], ['AND'], ['email'] => 'lexa@mail.ru']);

Если необходимо указание пармаетров ячеек таблиц, напрмер, где стобец name равен столбцу email, то перед параметром необходимо ставить ':'. 
Пример запроса:
##### $this -> db -> queryBuilder('update') -> table('users') -> set([['id' => ':age'], ['email' => 'test@yandex.ru']]) -> where([['id' => 8], ['AND'], ['email'] => ':id']]);
***
### delete

##### $this -> db -> queryBuilder('delete') -> from('users') -> where([['id' => 5], ['OR'], ['id' => 18]]);

### insert

##### $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['id', 'email', 'age']) -> values([8, 'toxa@hacker.ua', 49]);
Если параметр в columns один, то допускатеся несколько нотаций columns('id') и columns(['id'])
