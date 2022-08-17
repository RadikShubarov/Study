#define DOCTEST_CONFIG_IMPLEMENT_WITH_MAIN
#include <doctest.h>
#include <producer_consumer.h>

TEST_CASE("big_numbers") {
  unit_test = true;
  text = "750 330 222222 255552 23312 42322 77777 88888 99999 10000";
  int res = run_threads();
  CHECK(res == 821152);
}
