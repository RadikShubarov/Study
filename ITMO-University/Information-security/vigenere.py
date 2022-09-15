# Программа, осуществляющая шифрование и дешифрование шифра Виженера и частотный криптоанализ.

# Поместите программу и исходный текст в одну директорию.

# Открыть файл и извлечь содержимое в строковую переменную

with open('message.txt', encoding='utf8') as msg:
    message = msg.read()
    msg.close()

# Вводим ключ шифрования

key = input('What is key?\n')

# Допустимые символы шифра

symbols = "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя'.,!: "

# Функция выравнивающая ключ по исходному тексту.

def get_aligned_key(key):
    diff_numb = len(message) - len(key)
    aligned_key = key
    counter = 0
    while counter < diff_numb:
        aligned_key += key[counter % len(key)]
        counter += 1
    return aligned_key

# Данная функция находит позицию символа и выдает ее позицию.
def get_pos(symbol):
    for counter, pos in enumerate(symbols):
        if (symbol == pos):
            return counter


# Функция возвращающая символ по его позиции.

def get_encrypt_string (mod):
    for counter, pos in enumerate(symbols):
        if (mod == counter):
            return pos


# Функция шифрования Виженера.

def encrypt(message, aligned_key):
    encrypt_res = ''
    for counter, pos in enumerate(message):
        shift_pos = get_pos(pos) + get_pos(aligned_key[counter])
        mod = (shift_pos + 1) % len(symbols)
        encrypt_res += get_encrypt_string(mod)
    return encrypt_res

# Функция дешифрования Виженера.

def decrypt(encrypt_res, aligned_key):
    decrypt_res = ''
    for counter, pos in enumerate(encrypt_res):
        reverse_shift = get_pos(pos) - get_pos(aligned_key[counter])
        modc = (reverse_shift - 1) % len(symbols)
        decrypt_res += get_encrypt_string(modc)
    return decrypt_res

# Функция частотного анализа для исходного и зашифрованного текста.
def frequency (msg):
    message_list = list(msg)
    res_list = []
    for counter, pos in enumerate(msg):
        temp_str = pos + "-" + str(message_list.count(pos) / len(msg))
        if temp_str not in res_list:
            res_list.append(temp_str)
    res_list.sort()
    return res_list

# Вызов функций

print("Выравнивается ключ..")
aligned_key = get_aligned_key(key)
print("Происходит шифрование текста..")
print(encrypt(message, aligned_key))
print("Происходит дешифрация текста..")
print(decrypt(encrypt(message, aligned_key), aligned_key))
print("Выполняется частотный анализ..")
print(frequency(message))
print(frequency(encrypt(message, aligned_key)))
