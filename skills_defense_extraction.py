import pandas as pd

#reading in raw data through pandas read_csv command
playing_pos_data = pd.read_csv('PlayerPlayingPositionData.csv')
print(playing_pos_data)

#extract total number of rows for iteration
total_rows = playing_pos_data.shape[0]

#create new .sql file to run on sql to insert table
f = open("defense.sql","w")
print("DROP TABLE IF EXISTS Defense; \nCREATE TABLE Defense(Player_id INT, CB INT, LB INT, LCB INT, LWB INT, RB INT, RCB INT, RWB INT);\n", file=f)

for i in range(0,total_rows):
	print("INSERT into Defense values (", playing_pos_data["ID"][i], ", ", playing_pos_data["CB"][i], ", ", playing_pos_data["LB"][i], ", ", playing_pos_data["LCB"][i], ", ", playing_pos_data["LWB"][i], ", ", playing_pos_data["RB"][i], ", ", playing_pos_data["RCB"][i], ", ", playing_pos_data["RWB"][i], ");",sep="", file=f)

f.close()