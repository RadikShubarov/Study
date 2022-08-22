def quick_sort(array):
    if len(array) < 2:
        return array
    else:
        bolt = array[0]
        less_bolt = [i for i in array[1:] if i <= bolt]
        greater_bolt = [i for i in array[1:] if i > bolt]
        return quick_sort(less_bolt) + [bolt] + quick_sort(greater_bolt)


print(quick_sort([7, 7, 1, 9, 4, 3, 4, 6, 8]))
