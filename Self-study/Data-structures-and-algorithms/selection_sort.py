# Selection sort
# O(n) = n^2

def find_min_el(array):
    min_el = array[0]
    min_index = 0
    for i in range(1, len(array)):
        if array[i] < min_el:
            min_el = array[i]
            min_index = i
    return min_index


def selection_sort(array):
    result_array = []
    for i in range(len(array)):
        min_el = find_min_el(array)
        result_array.append(array.pop(min_el))
    return result_array


print(selection_sort([5, 7, 9, 2, 4, 6]))
