import pandas as pd
import collections

country_data = pd.read_csv('country.csv')

country_total_rows = country_data.shape[0]
country_file = open('country.sql', 'w')

country_file.write("DROP TABLE IF EXISTS Country; \nCREATE TABLE Country (NTC VARCHAR(3), Country_Name VARCHAR(20), "
                  "Capital VARCHAR(20), Continent VARCHAR(2), Development VARCHAR(20), Sub_region VARCHAR(35));\n\n")

for i in range(country_total_rows):
    country_file.write("INSERT into Country values (" + '"' + str(country_data["FIFA"][i]) + '"' + ", "
                       + '"' + str(country_data["official_name_en"][i]) + '"' + ", "
                       + '"' + str(country_data["Capital"][i]) + '"' + ", "
                       + '"' + str(country_data["Continent"][i]) + '"' + ", "
                       + '"' + str(country_data["Developed / Developing Countries"][i]) + '"' + ", "
                       + '"' + str(country_data["Sub-region Name"][i]) + '"' + ");\n")

country_file.close()