import csv


with open('TiendaDeServicios.csv') as csvfile:
    reader = csv.reader(csvfile, delimiter=',', quotechar='"')
    encabezado = (next(reader))
    encabezado[0] = 'id_tienda_s'
    with open('tiendasdeservicios.csv', 'w') as file:
        file.write((',').join(encabezado[:-1]))
    for line in reader:
        print(line)
        for i in line:
            if '\n' in i:
                line[2] = line[2].replace('\n', ' ').replace(',', '.')
        with open('tiendasdeservicios.csv', 'a') as file:
            line = (',').join(line[:-1])
            file.write('\n' + line)

with open('tiendasdeservicios.csv') as csvfile:
    reader = csv.reader(csvfile, delimiter=',', quotechar='"')
    for i in reader:
        print(i)