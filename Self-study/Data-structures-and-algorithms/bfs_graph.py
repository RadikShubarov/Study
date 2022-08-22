from collections import deque

graph = {}
graph['my_phone'] = ['Ruslan', 'Akper', 'Gadji']
graph['Ruslan'] = ['Nursultan', 'Akper']
graph['Gadji'] = ['Asel', 'Timur']
graph['Akper'] = ['Rufat', 'Farid']
graph['Nursultan'] = []
graph['Asel'] = []
graph['Timur'] = []
graph['Rufat'] = []
graph['Farid'] = []


def search(name):
    target = input()
    search_queue = deque()
    search_queue += graph[name]
    searched = []
    while search_queue:
        person = search_queue.popleft()
        if not person in searched:
            if person == target:
                print(person + " is find!")
                return True
            else:
                search_queue += graph[person]
                searched.append(person)
    return False


search("my_phone")
