import pandas as pd

#reading in raw data through pandas read_csv command
playing_pos_data = pd.read_csv('PlayerPlayingPositionData.csv')
print(playing_pos_data)

#extract total number of rows for iteration
total_rows = playing_pos_data.shape[0]

#create new .sql file to run on sql to insert table
f = open("midfield.sql","w")
print("DROP TABLE IF EXISTS Midfield; \nCREATE TABLE Midfield(Player_id INT, Center_Attacking_Midfielder INT, Center_Defensive_Midfielder INT, Center_Midfielder INT, Left_Attacking_Midfielder INT, Left_Center_Midfielder INT, Left_Defensive_Midfielder INT, Left_Midfielder INT, Right_Attacking_Midfielder INT, Right_Center_Midfielder INT, Right_Defensive_Midfielder INT, Right_Midfielder INT);\n", file=f)

for i in range(0,total_rows):
	print("INSERT into Midfield values (", playing_pos_data["ID"][i], ", ", playing_pos_data["CAM"][i], ", ", playing_pos_data["CDM"][i], ", ", playing_pos_data["CM"][i], ", ", playing_pos_data["LAM"][i], ", ", playing_pos_data["LCM"][i], ", ", playing_pos_data["LDM"][i], ", ", playing_pos_data["LM"][i], ", ", playing_pos_data["RAM"][i], ", ", playing_pos_data["RCM"][i], ", ", playing_pos_data["RDM"][i], ", ", playing_pos_data["RM"][i],");",sep="", file=f)

f.close()