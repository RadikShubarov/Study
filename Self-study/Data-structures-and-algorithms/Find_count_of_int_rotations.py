# binary search in rotation array
# O(n) = log2(n)

def find_count_of_integer_rotations(rotation_array):
    left_index = 0
    right_index = len(rotation_array) - 1
    while left_index <= right_index:
        if rotation_array[left_index] <= rotation_array[right_index]:
            return left_index
        mid = (left_index + right_index) // 2
        if (rotation_array[mid] <= rotation_array[(mid - 1 + len(rotation_array)) % len(rotation_array)]
                and rotation_array[mid] <= rotation_array[(mid + 1) % len(rotation_array)]):
            return mid
        elif rotation_array[mid] <= rotation_array[right_index]:
            right_index = mid - 1
        elif rotation_array[mid] >= rotation_array[left_index]:
            left_index = mid + 1


# test input
print(find_count_of_integer_rotations([2, 5, 6, 8, 9, 10, 1]))
