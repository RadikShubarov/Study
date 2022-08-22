import sys

graph = {}
graph['Astana'] = {}
graph['Almaty'] = {}
graph['Uralsk'] = {}
graph['Pavlodar'] = {}
graph['Aktau'] = {}
graph['Astana']['Almaty'] = 1.40
graph['Astana']['Uralsk'] = 2.30
graph['Astana']['Pavlodar'] = 1.10
graph['Uralsk']['Aktau'] = 1.15
graph['Almaty']['Aktau'] = 3.20
graph['Pavlodar']['Aktau'] = 7
infinity = float("inf")
costs = {}
costs['Almaty'] = 1.40
costs['Uralsk'] = 2.30
costs['Pavlodar'] = 1.10
costs['Aktau'] = infinity
parents = {}
parents['Almaty'] = 'Astana'
parents['Uralsk'] = 'Astana'
parents['Pavlodar'] = 'Astana'
parents['Aktau'] = None
processed = []
print("Write target city:")
target = input()
if target == 'Astana':
    print("This is start city!")
    quit


def find_lowest_cost_node(costs):
    lowest_cost = float("inf")
    lowest_cost_node = None
    for node in costs:
        cost = costs[node]
        if cost < lowest_cost and node not in processed:
            lowest_cost = cost
            lowest_cost_node = node
    return lowest_cost_node


node = find_lowest_cost_node(costs)
while node is not None:
    cost = costs[node]
    neighbors = graph[node]
    for n in neighbors.keys():
        new_cost = cost + neighbors[n]
        if costs[n] > new_cost:
            costs[n] = new_cost
            parents[n] = node
    processed.append(node)
    node = find_lowest_cost_node(costs)
# min distance result
print(parents[target])
