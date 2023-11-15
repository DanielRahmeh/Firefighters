class TableBlueprint:
    def __init__(self, name: str, attributes: dict) -> None:
        self.name = name
        self._attributes = attributes

    def add_attribute(self, name: str, type: str) -> None:
        self._attributes[name] = type

    def remove_attribute(self, name: str) -> None:
        self._attributes.pop(name)

    @property
    def attributes(self) -> dict:
        return self._attributes

    def get_attribute_type(self, name: str) -> type:
        return self._attributes[name]
    
    def get_attribute_name(self, type: str) -> list[str]:
        names = []
        for (name, attr_type) in self._attributes.items():
            if attr_type == type:
                names.append(name)
        return names

    def __str__(self) -> str:
        return f"Table(name={self.name}, attributes={self.attributes})"

    def __repr__(self) -> str:
        return str(self)


class Table:
    def __init__(self) -> None:
        attributes: dict[str, list] = {}

    def add_datas(self, name: str, data: list) -> None:
        self.attributes[name] = data

    def remove_datas(self, name: str) -> None:
        self.attributes.pop(name)

    def add_data(self, name: str, data: object) -> None:
        self.attributes[name].append(data)
    
    def remove_data(self, name: str, data: object) -> None:
        self.attributes[name].remove(data)

    def get_datas(self, name: str) -> list:
        return self.attributes[name]

    def get_data(self, name: str, index: int) -> object:
        return self.attributes[name][index]

    def has_data(self, name: str, data: object) -> bool:
        return data in self.attributes[name]

    def __str__(self) -> str:
        return f"Table(attributes={self.attributes})"
    
    def __repr__(self) -> str:
        return str(self)


class TableMaker:
    def __init__(self, blueprint: TableBlueprint) -> None:
        self.blueprint = blueprint

    def make(self) -> Table:
        table = Table()
        for (name, type) in self.blueprint.attributes.items():
            attributes: list[type] = []
            table.add_datas(name, attributes)
        return table


class Database:
    def __init__(self, tables: list[Table]) -> None:
        self._tables = tables

    def add_table(self, table: Table) -> None:
        self._tables.append(table)

    def get_table(self, name: str) -> Table:
        for table in self._tables:
            if table.name == name:
                return table
        return None

    def remove_table(self, name: str) -> None:
        for table in self._tables:
            if table.name == name:
                self._tables.remove(table)

    def __str__(self) -> str:
        return f"Database(tables={self.tables})"

    def __repr__(self) -> str:
        return str(self)
