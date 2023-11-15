from utils import Singleton
from serialize.serialized_file_creator import TableTypeSerializer
import os
import json

class Initializer(metaclass=Singleton):
    def __init__(self):
        self._tables = []
        self._create_directory("generator/config")
        self._create_directory("generator/config/tables")
        self._create_json_file(TableTypeSerializer.DEFAULT_FILE_TYPE, 
                               TableTypeSerializer.DEFAULT_TYPE_MATCH)

    def _create_directory(self, directory: str) -> None:
        if not os.path.exists(directory):
            os.mkdir(directory)

    def _create_json_file(self, file: str, data) -> None:
        if not os.path.exists(file):
            with(open(file, "w")) as f:
                json.dump(data, f, indent=4)
