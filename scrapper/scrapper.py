import mysql.connector
import requests
from datetime import datetime


def obtenConexion():
    return mysql.connector.connect(
        host="127.0.0.1",
        user="root",
        passwd="root",
        database='coronachan'
    )


def obtenPaises():
    return requests.get(url='https://api.covid19api.com/countries').json()


def obtenPais(nombrePais):
    strPais = 'https://api.covid19api.com/total/country/%s' % nombrePais
    return requests.get(url = strPais).json()


def insertaPaises():
    print('Obten paises')
    paises = obtenPaises()
    print('Paises obtenidos')
    strPaises = "insert into paises (clave_pais, nombre, iso2) values (%s, %s, %s)"
    db = obtenConexion()
    for pais in paises:
        clave = pais['Slug']
        nombre = pais['Country']
        iso2 = pais['ISO2']
        print(clave, nombre, iso2)
        c = db.cursor()
        c.execute(strPaises, (clave, nombre, iso2))
        db.commit()
    db.close()


def insertaDatosPorPais():
    print('Obten paises')
    paises = obtenPaises()
    print('Paises obtenidos')
    db = obtenConexion()
    paises = obtenPaises()
    formato = "%Y-%m-%dT%H:%M:%SZ"
    strRegistro = 'insert into registro_dia (fecha, confirmados, muertes, recuperados, clave_pais) values (%s, %s, %s, %s, %s)'
    for pais in paises:
        slug = pais['Slug']
        print('Obteniendo datos de pais %s' % slug)
        dias = obtenPais(slug)
        print('Datos de %s obtenidos' % slug)
        for dia in dias:
            confirmados = dia['Confirmed']
            muertes = dia['Deaths']
            recuperados = dia['Recovered']
            fecha = datetime.strptime(dia['Date'], formato)
            c = db.cursor()
            c.execute(strRegistro, (
                str(fecha),
                confirmados,
                muertes,
                recuperados,
                slug
            ))
            db.commit()
    db.close()


def main():
    insertaPaises()
    insertaDatosPorPais()


if __name__ == '__main__':
    main()
