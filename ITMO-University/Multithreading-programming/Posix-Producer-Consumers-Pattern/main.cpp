#include "producer_consumer.h"

int main(int argc, char* argv[]) {
  if (argc >= 3) {
    std::stringstream n_stream(argv[1]);
    n_stream >> N;
    if (N == 0) N = 1;
    std::stringstream ms_stream(argv[2]);
    ms_stream >> consumeSleep;
    if (argc > 3 and strcmp(argv[3], "-debug") == 0) debug = true;
    std::cout << run_threads() << std::endl;
  } else {
    exit(1);
  }

  return 0;
}
