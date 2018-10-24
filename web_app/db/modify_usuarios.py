import csv

lista = []
for i in range(0, 161):
    lista.append(i)

with open('usuariosviejo.csv', newline='') as csvfile:
    reader = csv.reader(csvfile, delimiter=' ', quotechar='|')
    encabezado = (next(reader))[0]
    with open('usuarios.csv', 'w') as file:
        file.write(encabezado)
    for row in reader:
        #print(row)
        row2 = []
        work = True
        element2 = ''
        for i in range(0, len(row)):
            row[i] = row[i].split(',')
            for element in row[i]:
                #element = element.replace("\"", "")
                if work:
                    if "\"" in element[0]:
                        if  "\"" in element[len(element)-1]:
                            row2.append(element)
                        else:
                            element2 = element
                            work = False
                    else:
                        row2.append(element)
                else:
                    element2 += ' ' + element
                    if "\"" in element[len(element)-1]:
                        element = element2
                        row2.append(element)
                        work = True
        if row2[2] == 'S/A':
            row2[2] = ''
        if row2[4] == '"No Aplica"':
            row2[4] = ''
        row2[1] = row2[1].replace('"', '')
        row2[2] = row2[2].replace('"', '')
        while True:
            if int(row2[0]) == lista[0]:
                row = ','.join(row2)
                with open('usuarios.csv', 'a') as file:
                    file.write('\n' + row)
                lista.pop(0)
                break
            else:
                with open('usuarios.csv', 'a') as file:
                    new_row = [str(lista[0]),'','','','']
                    new_row = ','.join(new_row)
                    file.write('\n' + new_row)
                    lista.pop(0)

