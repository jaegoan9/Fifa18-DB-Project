import pandas as pd
player_position_data = pd.read_csv('PlayerPlayingPositionData')

total_rows = player_position_data.shape[0]

f = open("Preferred.sql","w")

print("DROP TABLE IF EXISTS Preferred; \nCREATE TABLE Preferred (Player_id INT, Preferred_Position VARCHAR(4));\n", file=f)

for i in range(0,total_rows):
	print("INSERT into Preferred values (", player_position_data["ID"][i], ", ", '"', player_position_data["Preferred Positions"], '"', ");",sep="", file=f)
f.close()