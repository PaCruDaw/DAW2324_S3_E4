from fastapi import FastAPI, HTTPException, Security
from fastapi.security import APIKeyHeader
from fastapi.middleware.cors import CORSMiddleware
import httpx
import base64
from httpx import Headers
import mysql.connector
import json
from celery import Celery
from celery.schedules import crontab
import schedule
import time

# variable per guardar servei fast api
app = FastAPI()

# variable per guardar servei apikeys

api_key_header = APIKeyHeader(name="X-API-Key")

origins = [
    "http://localhost" 
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],  # Puedes restringir a métodos específicos (e.g., ["GET", "POST"])
    allow_headers=["*"],  # Puedes restringir a encabezados específicos si es necesario
)

def get_db_info():
    with open("config.json", "r") as config_file:
            config_data = json.load(config_file)
            db_config = config_data["database_config"]
            return db_config

def get_key_api():
    with open("config.json", "r") as keys_file:
            config_data = json.load(keys_file)
            api_key = config_data["parametres_seguretat"]["apy_keys"]
            return api_key

def get_info_picanova():
    with open("config.json", "r") as info_picanova:
            config_data = json.load(info_picanova)
            user_picanova = config_data["parametres_seguretat"]["info_picanova"]["user"]
            pass_picanova = config_data["parametres_seguretat"]["info_picanova"]["pass"]
            return [user_picanova,pass_picanova]

def get_api_key(api_key_header: str = Security(api_key_header)) -> str:
    if api_key_header in get_key_api():
        return api_key_header
    raise HTTPException(
        status_code=status.HTTP_401_UNAUTHORIZED,
        detail="Invalid or missing API Key",
    )

def get_credentials():
    username = get_info_picanova()[0]
    password = get_info_picanova()[1]

    # Codificar las credenciales en base64
    credentials = base64.b64encode(f"{username}:{password}".encode()).decode()
    return credentials    

@app.get("/protected")
def protected_route(api_key: str = Security(get_api_key)):
    # Process the request for authenticated usersresponse = httpx.get(url, headers=custom_headers)
    return {"message": "Access granted!"}

@app.get("/peticionotraapi")
async def hacer_peticion(api_key: str = Security(get_api_key)):
    # URL de la API externa a la que deseas hacer la solicitud
    url = "https://api.picanova.com/api/beta/countries"

    async with httpx.AsyncClient() as client:
        auth_header = Headers({"Authorization": f"Basic {get_credentials()}"})
        response = httpx.get(url, headers=auth_header)

        if response.status_code == 200:
            # La solicitud se realizó con éxito, puedes manejar los datos de la respuesta aquí.
            data = response.json()
            names = [item["name"] for item in data["data"]]
            return(names)

        else:
            # Maneja los errores si la solicitud no fue exitosa
            return {"error": "No se pudo realizar la solicitud a la API externa"}

@app.get("/consultar_bd")
async def consultar_bd(api_key: str = Security(get_api_key)):

    try:
        # Conecta a la base de datos
        connection = mysql.connector.connect(**get_db_info())

        # Crea un cursor para ejecutar consultas SQL
        cursor = connection.cursor(dictionary=True)

        # Ejecuta una consulta
        query = "SELECT * FROM clients"
        cursor.execute(query)

        # Obtiene los resultados
        results = cursor.fetchall()

        # Cierra el cursor y la conexión
        cursor.close()
        connection.close()

        return results
    except Exception as e:
        return {"error": str(e)}

@app.get("/dbventes")
async def consultar_bd(api_key: str = Security(get_api_key)):

    try:
        # Conecta a la base de datos
        connection = mysql.connector.connect(**get_db_info())

        # Crea un cursor para ejecutar consultas SQL
        cursor = connection.cursor(dictionary=True)

        # Ejecuta una consulta
        query = "SELECT * FROM `vistaPedidosGrafica`"
        cursor.execute(query)

        # Obtiene los resultados
        results = cursor.fetchall()

        # Cierra el cursor y la conexión
        cursor.close()
        connection.close()

        return results
    except Exception as e:
        return {"error": str(e)} 


@app.get("/test")
def read_test():
    return {"La API funciona"}

@app.get("/deapiadb")
async def hacer_peticion(api_key: str = Security(get_api_key)):
    # URL de la API externa a la que deseas hacer la solicitud
    try:
        url = "https://api.picanova.com/api/beta/countries"

        async with httpx.AsyncClient() as client:
            auth_header = Headers({"Authorization": f"Basic {get_credentials()}"})
            response = httpx.get(url, headers=auth_header)

            if response.status_code == 200:
                # La solicitud se realizó con éxito, puedes manejar los datos de la respuesta aquí.
                data = response.json()
                data_list = data["data"]

                # Ahora, crearemos una lista de diccionarios con ambas claves
                info_list = [{"country": item["name"], "countrycode": item.get("country_code", None)} for item in data_list]

                connection = mysql.connector.connect(**get_db_info())
                # Crea un cursor para ejecutar consultas SQL
                cursor = connection.cursor()

                query = "TRUNCATE TABLE `project`.`country`"
                queryinsert = "INSERT INTO `country`(`countryName`,`countryCode`) VALUES (%s,%s);"

                cursor.execute(query)

                for item in info_list:
                    country = item["country"]
                    countrycode = item["countrycode"]
                    cursor.execute(queryinsert, (country, countrycode))

                connection.commit()
                cursor.close()
                connection.close()
                return "La BD ha sido actualizada"

            else:
                # Maneja los errores si la solicitud no fue exitosa
                return {"error": "No se pudo realizar la solicitud a la API externa"}

    except mysql.connector.Error as e:
        return {"error": f"Error de MySQL: {e}"}
    except Exception as e:
        return {"error": f"Error no manejado: {e}"}

@app.get("/deapiaproductes")
async def hacer_peticion(api_key: str = Security(get_api_key)):
    # URL de la API externa a la que deseas hacer la solicitud
    try:
        url = "https://api.picanova.com/api/beta/products"

        async with httpx.AsyncClient() as client:
            auth_header = Headers({"Authorization": f"Basic {get_credentials()}"})
            response = httpx.get(url, headers=auth_header)

            if response.status_code == 200:
                # La solicitud se realizó con éxito, puedes manejar los datos de la respuesta aquí.
                data = response.json()
                data_list = data["data"]
                connection = mysql.connector.connect(**get_db_info())
                # Crea un cursor para ejecutar consultas SQL
                cursor = connection.cursor()
                queryinsert = "INSERT INTO `products`(`idProduct`,`productName`) VALUES (%s,%s);" 

                dictionary = {}

                for item in data_list:
                    idProducte = item["id"]
                    nom = item["name"]
                    nuevoselementos={idProducte:nom}
                    dictionary.update(nuevoselementos)
                    cursor.execute(queryinsert, (idProducte, nom))

                connection.commit()
                cursor.close()
                connection.close()
                return "La BD ha sido actualizada"

            else:
                # Maneja los errores si la solicitud no fue exitosa
                return {"error": "No se pudo realizar la solicitud a la API externa"}

    except mysql.connector.Error as e:
        return {"error": f"Error de MySQL: {e}"}
    except Exception as e:
        return {"error": f"Error no manejado: {e}"}
    
@app.get("/deapiavariants")
async def hacer_peticion(api_key: str = Security(get_api_key)):
    # URL de la API externa a la que deseas hacer la solicitud
    try:

        url = "https://api.picanova.com/api/beta/products"

        async with httpx.AsyncClient() as client:
            auth_header = Headers({"Authorization": f"Basic {get_credentials()}"})
            response = httpx.get(url, headers=auth_header)

            if response.status_code == 200:
                data = response.json()
                data_list = data["data"]

                for item in data_list:
                    url2 = "https://api.picanova.com/api/beta/variants/"
                    id = str(item["id"])
                    url2 += id

                    async with httpx.AsyncClient() as client:
                        auth_header = Headers({"Authorization": f"Basic {get_credentials()}"})
                        response = httpx.get(url2, headers=auth_header)

                        if response.status_code == 200:
                            data = response.json()
                            data_list = data["data"]
                            idV = data_list.get("variant_id")
                            idP = data_list.get("id")
                            name = data_list.get("name")
                            connection = mysql.connector.connect(**get_db_info())
                            cursor = connection.cursor()
                            queryinsert = "INSERT INTO `productVariant`(`idVariant`, `idProduct`,`variantName`) VALUES (%s,%s,%s);"
                            cursor.execute(queryinsert, (idV, idP, name))
                            connection.commit()
                            cursor.close()
                            connection.close()

                return "La BD ha sido actualizada"

            else:
                # Maneja los errores si la solicitud no fue exitosa
                return {"error": "No se pudo realizar la solicitud a la API externa"}

    except mysql.connector.Error as e:
        return {"error": f"Error de MySQL: {e}"}
    except Exception as e:
        return {"error": f"Error no manejado: {e}"}

@app.get("/deapiaopcions")
async def hacer_peticion(api_key: str = Security(get_api_key)):
    # URL de la API externa a la que deseas hacer la solicitud
    try:

        url = "https://api.picanova.com/api/beta/products"

        async with httpx.AsyncClient() as client:
            auth_header = Headers({"Authorization": f"Basic {get_credentials()}"})
            response = httpx.get(url, headers=auth_header)

            if response.status_code == 200:
                data = response.json()
                data_list = data["data"]

                for item in data_list:
                    url2 = "https://api.picanova.com/api/beta/variants/"
                    id = str(item["id"])
                    id2 = int(item["id"])
                    url2 += id

                    async with httpx.AsyncClient() as client:
                        auth_header = Headers({"Authorization": f"Basic {get_credentials()}"})
                        response_variants = httpx.get(url2, headers=auth_header)

                        if response_variants.status_code == 200:
                            variant_data = response_variants.json()["data"]
                            options = variant_data.get("options", {})

                            if isinstance(options, dict):
                                for option_id, option_data in options.items():
                                    option_id = int(option_id)
                                    is_required = option_data.get("is_required", False)
                                    connection = mysql.connector.connect(**get_db_info())
                                    cursor = connection.cursor()
                                    queryinsert = "INSERT INTO `options`(`idOption`, `idVariant`, `is_required`) VALUES (%s,%s,%s);"
                                    cursor.execute(queryinsert, (option_id, id2, is_required))
                                    connection.commit()
                                    cursor.close()
                                    connection.close()

                return "La BD ha sido actualizada"

            else:
                # Maneja los errores si la solicitud no fue exitosa
                return {"error": "No se pudo realizar la solicitud a la API externa"}

    except mysql.connector.Error as e:
        return {"error": f"Error de MySQL: {e}"}
    except Exception as e:
        return {"error": f"Error no manejado: {e}"}

@app.get("/deapiavalues")
async def hacer_peticion(api_key: str = Security(get_api_key)):
    # URL de la API externa a la que deseas hacer la solicitud
    try:

        url = "https://api.picanova.com/api/beta/variants/2"

        async with httpx.AsyncClient() as client:
            auth_header = Headers({"Authorization": f"Basic {get_credentials()}"})
            response = httpx.get(url, headers=auth_header)

            if response.status_code == 200:
                data = response.json()
                data_list = data["data"]["options"]
                for option_id, option_data in data_list.items():
                    values = option_data.get("values", [])
                    for value in values:
                        idValue = value["id"]
                        name = value["name"]
                        connection = mysql.connector.connect(**get_db_info())
                        cursor = connection.cursor()
                        queryinsert = "INSERT INTO `values`(`idValue`, `idOption`, `name`) VALUES (%s,%s,%s);"
                        cursor.execute(queryinsert, (idValue, option_id, name))
                        connection.commit()
                        cursor.close()
                        connection.close()

                return "La BD ha sido actualizada"

            else:
                # Maneja los errores si la solicitud no fue exitosa
                return {"error": "No se pudo realizar la solicitud a la API externa"}

    except mysql.connector.Error as e:
        return {"error": f"Error de MySQL: {e}"}
    except Exception as e:
        return {"error": f"Error no manejado: {e}"}