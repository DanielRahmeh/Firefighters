from initializer import Initializer
import mysql.connector
from serialize.serialized_file_creator import TableTypeSerializer
import db.objects as objects

def main():
    # Replace 'your_username', 'your_password', and 'your_database' with your MySQL credentials
    # If you don't have a password, you can omit the 'password' parameter or set it to an empty string.
    # config = {
    #     'user': 'root',
    #     'password': '',
    #     'host': 'localhost',
    #     'database': 'firefighter',
    #     'raise_on_warnings': True
    # }

    # try:
    #     # Create a connection to the MySQL server
    #     connection = mysql.connector.connect(**config)
    #     cursor = connection.cursor()

    #     if connection.is_connected():
    #         print('Connected to MySQL database')
    #     # Specify the table name for which you want to get column information
    #     table_name = 'alert'

    #     # Query to get column information from the 'information_schema' database
    #     column_query = f"SELECT COLUMN_NAME, DATA_TYPE FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '{config['database']}' AND TABLE_NAME = '{table_name}'"
    #     cursor.execute(column_query)

    #     # Fetch all the rows
    #     columns = cursor.fetchall()

    #     # Display the column information
    #     for column in columns:
    #         print(f"Column Name: {column[0]}, Data Type: {column[1]}")

    # except mysql.connector.Error as err:
    #     print(f"Error: {err}")

    # finally:
    #     # Close the connection
    #     if 'connection' in locals():
    #         connection.close()
    #         print('MySQL connection closed')

    # write TableBlueprint test
    table_blueprint = objects.TableBlueprint("test")
    table_blueprint.add_attribute("name", "varchar")
    table_blueprint.add_attribute("age", "int")
    table_blueprint.add_attribute("address", "varchar")
    table_blueprint.add_attribute("email", "varchar")
    table_blueprint.add_attribute("phone", "varchar")
    table_blueprint.add_attribute("job", "varchar")
    table_blueprint.add_attribute("company", "varchar")
    table_blueprint.add_attribute("ssn", "varchar")
    table_blueprint.add_attribute("residence", "varchar")
    table_blueprint.add_attribute("current_location", "varchar")
    table_blueprint.add_attribute("blood_group", "varchar")

    #write test for TableTypeSerializer
    table_type_serializer = TableTypeSerializer()
    table_type_serializer.serialize(table_blueprint)



if "__main__" == __name__:
    Initializer()
    main()
