#pragma once

#include <pthread.h>

#include <string.h>

#include <unistd.h>

#include <cstdlib>

#include <iostream>

#include <sstream>

#include <string>

#include <condition_variable>

#include <mutex>

// the declaration of run threads can be changed as you like
// int run_threads();

//Переменные ввода
extern int N;
extern bool debug;        // false
extern int consumeSleep;  // 0
extern std::string text;
extern int result;
extern bool unit_test;  // false

int run_threads();
