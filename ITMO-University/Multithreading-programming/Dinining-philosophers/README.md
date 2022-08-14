# Обедающие философы

В этой задаче всегда 5 философов. Когда философ хочет кушать, то вызывает метод:

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
