# Как работать с Query builder
***

В файле с модулем контроллера пишем:
### $this -> db -> queryBuilder(...);
Без указания типа запроса ничего не сработает
Поэтому на месте троеточия нужно поставить на выбор:
##### select, insert, delete, update
***

### select
##### $this -> db -> queryBuilder('select') -> select('*') -> from('users') -> where(['id' => 5]) -> query();
Если в where необходимо добавить несколько параметров(AND, OR), то запрос будет выглядить так:
$this -> db -> queryBuilder('select') -> select('*') -> from('users') -> where([['id' => 5], ['OR'], ['email' => 'test@gmail.com']]);
***

### update

##### $this -> db -> queryBuilder('update') -> table('users') -> set(['id' => 5]) -> where(['id' => 8]) -> query();
Множество параметров
##### $this -> db -> queryBuilder('update') -> table('users') -> set([['id' => 5], ['email' => 'test@yandex.ru']]) -> where([['id' => 8], ['AND'], ['email'] => 'lexa@mail.ru']) -> query();

Если необходимо указание пармаетров ячеек таблиц, напрмер, где стобец name равен столбцу email, то перед параметром необходимо ставить ':'. 
Пример запроса:
##### $this -> db -> queryBuilder('update') -> table('users') -> set([['id' => ':age'], ['email' => 'test@yandex.ru']]) -> where([['id' => 8], ['AND'], ['email'] => ':id']]) -> query();
***
### delete

##### $this -> db -> queryBuilder('delete') -> from('users') -> where([['id' => 5], ['OR'], ['id' => 18]]) -> query();

***
### insert

##### $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['id', 'email', 'age']) -> values([8, 'toxa@hacker.ua', 49]) -> query();
Множество values:
##### $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['id', 'email', 'age']) -> values([[8, 'toxa@hacker.ua', 49], [467, 'modved@russia.ua', 45]]) -> query();
Если параметр в columns один, то допускатеся несколько нотаций columns('id') и columns(['id'])

***

# API

## /info
Данный метод возвращает общую информацию о блоге, такую как заголовок, количество постов и другие высокоуровневые данные

## /avatar
Данный метод возвращает аватар пользователя

## /likes 
Этот метод может быть использован для получения лайков из блога.

## /following
Этот метод может использоваться для извлечения списка блогов, за которыми следует пользователь, в порядке от самых последних, за которыми следуют, до первых.

## /posts 
Получить опубликованные посты

## /post
Создать новый пост в блоге 

## /post/edit 
Редактировать пост в блоге

## /post/delete 
Удалить пост

## /user/info
Получить информацию о пользователе

## /user/likes 
получить пользовательские лайки

## /user/following 
Получить блоги, за которыми следит пользователь

## /user/follow 
Подписаться на блог

## /user/unfollow 
отписаться от блога

## /user/like 
лайк поста

## /user/unlike 
анлайк поста

## /tagged 
Получить посты с тегом