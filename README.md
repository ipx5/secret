# Как работать с Query builder
***

Работа с БД в моделях.
Инициализация в папке model:
### $this -> db -> queryBuilder(...);
На месте троеточия необходимо указать тип запроса(регистронезависимо):
##### select, insert, delete, update


### Select
 $this -> db -> queryBuilder('select') -> select('*') -> from('users') -> where(['id' => 5]) -> query();

 $this -> db -> queryBuilder('select') -> select('id, mail, password') -> from('users') -> where(['id' => 5, 'AND', 'email' = 'test@test.ru' ]) -> query();

 $this -> db -> queryBuilder('select') -> select(['id', 'mail', 'password']) -> from('users') -> where(['id' => 5, 'AND', 'email' = 'test@test.ru' ]) -> query();

 $this -> db -> queryBuilder('select') -> select([['id'], 'mail', 'password']) -> from('users') -> where(['id' => 5, 'OR', 'id' = '35' ]) -> query();

 $this -> db -> select(['p.id', 'p.email']) -> 
 from(['roles_privileges' => 'rp']) -> join('JOIN', ['privileges' => 'p'] , ['p.id' => 'rp.privilege_id']) 
 -> where(['rp.role_id' => 1]) -> query();

   
         $this -> db -> queryBuilder('select') -> select(['a.id' => 'id_a','a.fruit' => 'fruit_a']) -> from(['basket_a' => 'a']) ->
        join('FULL', ['basket_b' => 'b'], ['!', 'a.fruit' => 'b.fruit', 'OR' , 'a.bread' => 'b.bread']) -> where(['a.id' => ':b.id']) -> query();
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
Этот метод может использоваться для извлечения списка блогов, на которые подписан пользователь

## /followers 
Получить список пользователей, которые подписаны на блог

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

## /user/follow 
Подписаться на блог

## /user/unfollow 
отписаться от блога

## /user/like 
лайк поста

## /user/unlike 
анлайк поста
