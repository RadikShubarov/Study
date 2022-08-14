import java.util.concurrent.atomic.AtomicBoolean;

class DiningPhilosophers {
    private final AtomicBoolean[] forks = new AtomicBoolean[5];
      boolean[] isEat = new boolean[5];
     Semaphore sem;

    public DiningPhilosophers() {
        sem = new Semaphore(1);
        for (int i = 0; i < forks.length; i++) {
            forks[i] = new AtomicBoolean(false);
        }
        
    }

    // call the run() method of any runnable to execute its code
    public void wantsToEat(int philosopher,
                           Runnable pickLeftFork,
                           Runnable pickRightFork,
                           Runnable eat,
                           Runnable putLeftFork,
                           Runnable putRightFork)  throws InterruptedException {
        while (true) {
            sem.acquire();
            AtomicBoolean leftFork = forks[philosopher];
           
            if (leftFork.compareAndSet(false, true)) {
               
              
                AtomicBoolean rightFork = forks[(philosopher + 1) % forks.length];
                if (rightFork.compareAndSet(false, true)) {
                    sem.release();
                    pickLeftFork.run();
                    pickRightFork.run();
                    eat.run();
                    putRightFork.run();
                    rightFork.set(false);
                    putLeftFork.run();
                    leftFork.set(false);
                    
                    
                    break;
        
                } else {
                    leftFork.set(false);
                    sem.release();
                }
            } else {
                sem.release();
            }
        }
    }
}
