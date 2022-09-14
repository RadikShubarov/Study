with open('message.txt', encoding='utf8') as msg:
    message = msg.read()
    msg.close()
key = input('What is key?\n')
symbols = "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя'.,!: "


def get_aligned_key(key):
    diff_numb = len(message) - len(key)
    aligned_key = key
    counter = 0
    while counter < diff_numb:
        aligned_key += key[counter % len(key)]
        counter += 1
    return aligned_key


def get_pos(symbol):
    for counter, pos in enumerate(symbols):
        if (symbol == pos):
            return counter


def get_encrypt_string (mod):
    for counter, pos in enumerate(symbols):
        if (mod == counter):
            return pos


def encrypt(message, aligned_key):
    encrypt_res = ''
    for counter, pos in enumerate(message):
        gg = get_pos(pos) + get_pos(aligned_key[counter])
        mod = (gg + 1) % len(symbols)
        encrypt_res += get_encrypt_string(mod)
    return encrypt_res


def decrypt(encrypt_res, aligned_key):
    decrypt_res = ''
    for counter, pos in enumerate(encrypt_res):
        gc = get_pos(pos) - get_pos(aligned_key[counter])
        modc = (gc - 1) % len(symbols)
        decrypt_res += get_encrypt_string(modc)
    return decrypt_res


def frequency (msg):
    l = list(msg)
    res_list = []
    for counter, pos in enumerate(msg):
        temp_str = pos + "-" + str(l.count(pos))
        if temp_str not in res_list:
            res_list.append(temp_str)
    res_list.sort()
    return res_list

aligned_key = get_aligned_key(key)

print(encrypt(message, aligned_key))
print(decrypt(encrypt(message, aligned_key), aligned_key))
print(frequency(message))
print(frequency(encrypt(message, aligned_key)))
