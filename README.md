# Прежде чем начать рекомендую сделать 2 вещи:

*php artisan migrate
*php artisan db:seed


# Спроектировать систему голосования

## Условия выполнения
* Используем фреймворк Laravel и базу данных MySQL.
* Для стилизации применяем bootstrap.
* На сайте должна быть админка, защищённая логином и паролем.
* А админке мы можем добавить неограниченное количество голосований.
* Голосование представляет собой вопрос с возможными вариантами ответов.
* Голосования бывают с одним возможным вариантом ответа (radio button), а также с несколькими вариантами ответов (checkbox)
* В данный момент активным может быть только одно голосование.
* На фронтальной части простой пользователь видит текущее активное голосование.
* Простой пользователь может выбрать один или несколько ответов (в зависимости от типа голосования).
* После нажатия кнопки Сохранить пользователь видит сообщение с благодарностью за участие в голосовании, а также статистику, сколько раз проголосовали за каждый вариант ответа.
* Результат нужно загрузить в git, покажите что Вы понимаете зачем нужны коммиты