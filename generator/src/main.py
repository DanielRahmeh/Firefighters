import faker

def main():
    fake = faker.Faker()
    print(fake.name())

if "__main__" == __name__:
    main()
