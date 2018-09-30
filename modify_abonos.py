import csv
with open('abonosviejo.csv', newline='') as csvfile:
    reader = csv.reader(csvfile, delimiter=' ', quotechar='|')
    encabezado = (next(reader))[0]
    with open('abonos.csv', 'w') as file:
        file.write(encabezado)
    print(encabezado)
    for row in reader:
        row = row[0].split(',')
        row[1] = row[1].replace('.', '').replace('$', '')
        row = ','.join(row)
        print(row)
        with open('abonos.csv', 'a') as file:
            file.write('\n' + row)