#include "producer_consumer.h"
int N = 1;
int consumeSleep = 0;
bool unit_test = false;
bool debug = false;
std::string text;
//Разделяемые глобальные переменные
pthread_t* consumers;
pthread_mutex_t mtx;
pthread_mutex_t mtx_for_id;
pthread_cond_t cond;

bool isDataReady = false;
bool isProduceFinish = false;

int result = 0;
int number = 0;

using namespace std;

int get_tid() {
  // 1 to 3+N thread ID
  static thread_local std::shared_ptr<int> tid(new int);
  static int thread_id = 1;
  if (*tid == 0) {
    pthread_mutex_lock(&mtx_for_id);
    *tid = thread_id;
    thread_id++;
    pthread_mutex_unlock(&mtx_for_id);
  }
  return *tid;
}

void* producer_routine(void*) {
  stringstream in;
  in << text;
  text = "";
  while (!in.eof()) {
    pthread_mutex_lock(&mtx);
    in >> number;
    isDataReady = true;
    pthread_cond_broadcast(&cond);
    if (isDataReady) pthread_cond_wait(&cond, &mtx);
    pthread_mutex_unlock(&mtx);
  }
  pthread_mutex_lock(&mtx);
  isDataReady = true;
  isProduceFinish = true;

  pthread_cond_broadcast(&cond);
  pthread_mutex_unlock(&mtx);
  in.str("");
  in.clear();
  return nullptr;
}

void* consumer_routine(void*) {
  pthread_setcancelstate(PTHREAD_CANCEL_DISABLE, NULL);
  int particularSum = 0;
  while (!isProduceFinish) {
    pthread_mutex_lock(&mtx);
    while (!isDataReady) pthread_cond_wait(&cond, &mtx);

    if (isProduceFinish) {
      pthread_mutex_unlock(&mtx);
      break;
    }
    isDataReady = false;
    particularSum = particularSum + number;

    pthread_cond_signal(&cond);
    if (debug) printf("(%d, %d)\n", get_tid(), particularSum);
    pthread_mutex_unlock(&mtx);
    if (consumeSleep > 0) {
      int sleep = rand() % consumeSleep + 1;
      usleep(sleep * 1000);
    }
  }

  result = result + particularSum;
  pthread_setcancelstate(PTHREAD_CANCEL_ENABLE, NULL);
  pthread_exit(NULL);
  return nullptr;
}

void* consumer_interruptor_routine(void*) {
  while (!isProduceFinish) {
    int i = 0;
    if (N > 1) {
      i = rand() % (N - 1);
    }
    pthread_cancel(consumers[i]);
  }

  // interrupt random consumer while producer is running
  return nullptr;
}

int run_threads() {
  if (!unit_test) {
    getline(cin, text);
    cin.tie(nullptr);
    ios::sync_with_stdio(false);
  }
  pthread_t producer;
  pthread_t interrupt;
  pthread_create(&producer, NULL, producer_routine, NULL);

  consumers = new pthread_t[N];
  for (int i = 0; i < N; i++) {
    pthread_create(&consumers[i], NULL, consumer_routine, NULL);
  }

  pthread_create(&interrupt, NULL, consumer_interruptor_routine, NULL);
  pthread_join(producer, NULL);
  pthread_join(interrupt, NULL);
  for (int i = 0; i < N; i++) {
    pthread_join(consumers[i], NULL);
  }

  pthread_cond_destroy(&cond);
  pthread_mutex_destroy(&mtx);

  delete[] consumers;
  return result;
}
