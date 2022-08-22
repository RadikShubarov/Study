url_in_cache = {'server.ru': 1,
                'server.ru/guest': 2,
                'server.ru/contact': 3,
                'server.ru/authorization': 4,
                'server.ru/news': 5}
url = input()


def cache_decision(url_in_cache):
    if url_in_cache.get(url):
        print("process from cache..")
    else:
        print("process from servers..")


cache_decision(url_in_cache)
