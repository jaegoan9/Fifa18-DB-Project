import pandas as pd

personal_data = pd.read_csv('PersonalData.csv')

total_rows = personal_data.shape[0]

f = open("Value.sql","w")
print("DROP TABLE IF EXISTS Value; \nCREATE TABLE Value (Player_id INT, Player_Value VARCHAR(10), Player_Wage VARCHAR(10));\n", file=f)
for i in range(0,total_rows):
	print("INSERT into Value values (", personal_data["ID"], ", ", personal_data["Value"], ", ", personal_data["Wage"], ");",sep="", file=f)
f.close()