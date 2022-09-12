project(sqlite3)
cmake_minimum_required(VERSION 3.18.4)
set(CMAKE_INSTALL_PREFIX ${CMAKE_CURRENT_SOURCE_DIR}./)
file(GLOB CPPS "*.c")
add_definitions(-Wall -O2 -DSQLITE_THREADSAFE=0 -DSQLITE_OMIT_LOAD_EXTENSION)
add_executable(${PROJECT_NAME} ${CPPS})
target_link_libraries(${PROJECT_NAME})


