import pandas as pd

country_data = pd.read_csv('country-codes.csv',encoding ='latin1')
print(country_data)

total_rows = country_data.shape[0]

f = open("test1.sql", "w")
print("DROP TABLE IF EXISTS Country; \nCREATE TABLE Country (Country_Code VARCHAR(5), Country_Name VARCHAR(80), Capital VARCHAR(30), Development VARCHAR(20), Sub_Region VARCHAR(80), Continent VARCHAR(20));\n", file=f)

for i in range(0, total_rows):
	print("INSERT into Country values (", '"', str(country_data["FIFA"][i]),'"', ", ", '"', country_data["official_name_en"][i], '"', ", ", '"', country_data["Capital"][i], '"', ", ", '"', country_data["Developed / Developing Countries"][i], '"', ", ", '"', country_data["Sub-region Name"][i], '"', ", ", '"', country_data["Continent"][i], '"', ");",sep="", file=f)
f.close()

print(total_rows)