import pandas as pd

personal_data = pd.read_csv('PersonalData.csv')

total_rows = personal_data.shape[0]

print(personal_data["Wage"])
f = open("Value.sql","w")
print("DROP TABLE IF EXISTS Value; \nCREATE TABLE Value (Player_id INT, Player_Value VARCHAR(10), Player_Wage VARCHAR(10));\n", file=f)
print("meow")
print(total_rows)
for i in range(0,total_rows):
	print("INSERT into Value values (", personal_data["ID"][i], ", ", '"', personal_data["Value"][i], '"', ", ", '"', str(personal_data["Wage"][i]), '"', ");",sep="", file=f)
f.close()