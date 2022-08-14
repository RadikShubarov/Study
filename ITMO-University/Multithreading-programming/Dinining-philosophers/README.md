# Обедающие философы

Вам нужно зарегистрироваться на сайте [leetcode.com](https://leetcode.com/). Это система для решения задач, которые спрашивают на собеседованиях в крупные IT компании (Google, Amazon, Facebook, ...). Для выполнения лабораторной работы необходимо решить задачу [1226. The Dining Philosophers](https://leetcode.com/problems/the-dining-philosophers/). В этой задаче всегда 5 философов. Когда философ хочет кушать, то вызывает метод:

```c++
void wantsToEat(int philosopher,
                function<void()> pickLeftFork,
                function<void()> pickRightFork,
                function<void()> eat,
                function<void()> putLeftFork,
                function<void()> putRightFork);
```


 - philosopher - число от 0 до 4, <<имя>> философа
 - pickLeftFork, pickRightFork, eat, putLeftFork, putRightFork - действия которые он может сделать


Эту задачу можно решать методом атомарного захвата вилок или любым другим методом, который вам больше нравится. Если одновременно могут есть несколько философов, то они должны это делать.

**Требования:**
 - Решение оформляется как Merge Request
 - Работу можно делать на любом языке программирования который поддерживает leetcode
 - Все тесты должны быть успешно пройдены
 - Работа сдается во время практики

