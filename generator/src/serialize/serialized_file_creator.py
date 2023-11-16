import json
import db.objects as objects


class TableTypeSerializer:
    DEFAULT_FILE_TYPE = "generator/config/types.json"
    DEFAULT_TYPE_MATCH = {
        "varchar": "lorem.paragraph",
        "text": "lorem.paragraph",
        "char": "lorem.paragraph",
        "datetime": "date_time.date",
        "timestamp": "date_time.date_time",
        "decimal": "float",
        "double": "float",
        "float": "float",
        "tinyint": "boolean",
        "smallint": "int",
        "mediumint": "int",
        "int": "int",
        "bigint": "int",
        "year": "int",
    }

    def __init__(self) -> None:
        self._types: dict[str, str] = TableTypeSerializer.DEFAULT_TYPE_MATCH

    def serialize(self, blueprint: objects.TableBlueprint) -> str:
        self._serialize_types = {}
        self._types = self._get_default_types_match()

        for (name, type) in blueprint.attributes.items():
            self._serialize_types[name] = self._types[type]

        file_path = f"generator/config/tables/{blueprint.name}.json"
        self._create_json_file(file_path, self._serialize_types)

        return file_path

    def _get_default_types_match(self):
        with open(TableTypeSerializer.DEFAULT_FILE_TYPE, "r") as f:
            return json.load(f)

    def _create_json_file(self, file: str, data) -> None:
        with open(file, "w") as f:
            json.dump(data, f, indent=4)
