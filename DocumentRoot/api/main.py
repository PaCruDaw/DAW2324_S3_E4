from fastapi import FastAPI, HTTPException, Security
from fastapi.security import APIKeyHeader
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
    # Debes proporcionar un nombre de usuario y una contraseña para la autenticación básica.
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
            # names = []
            # for item in data:
            #     names.append(item["data"])
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
        query = "SELECT * FROM usuario"
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
                # names = []
                # for item in data:
                #     names.append(item["data"])
                data_list = data["data"]

                # Ahora, crearemos una lista de diccionarios con ambas claves
                info_list = [{"country": item["name"], "countrycode": item.get("country_code", None)} for item in data_list]
                
                connection = mysql.connector.connect(**get_db_info())
                # Crea un cursor para ejecutar consultas SQL
                cursor = connection.cursor()
                
                            
                query = "TRUNCATE TABLE `testdatabase2`.`pais`"
                queryinsert = "INSERT INTO `pais`(`nombre_pais`,`codigo_pais`) VALUES (%s,%s);"
                
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

def tarea_medianoche():
    try:
        url = "https://api.picanova.com/api/beta/countries"

        with httpx.Client() as client:
            auth_header = Headers({"Authorization": f"Basic {get_credentials()}"})
            response = client.get(url, headers=auth_header)

            if response.status_code == 200:
                data = response.json()
                data_list = data["data"]

                info_list = [
                    {"country": item["name"], "countrycode": item.get("country_code", None)}
                    for item in data_list
                ]

                connection = mysql.connector.connect(**get_db_info())
                cursor = connection.cursor()

                query = "TRUNCATE TABLE `testdatabase2`.`pais`"
                queryinsert = "INSERT INTO `pais`(`nombre_pais`,`codigo_pais`) VALUES (%s,%s);"

                cursor.execute(query)

                for item in info_list:
                    country = item["country"]
                    countrycode = item["countrycode"]
                    cursor.execute(queryinsert, (country, countrycode))

                connection.commit()
                cursor.close()
                connection.close()
                print("La BD ha sido actualizada")

            else:
                print("No se pudo realizar la solicitud a la API externa")

    except mysql.connector.Error as e:
        print(f"Error de MySQL: {e}")
    except Exception as e:
        print(f"Error no manejado: {e}")

# Agrega la tarea_medianoche a schedule
schedule.every(1).minute.do(tarea_medianoche)

if __name__ == "__main__":
    while True:
        schedule.run_pending()
        time.sleep(60)