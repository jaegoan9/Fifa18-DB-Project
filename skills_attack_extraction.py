import pandas as pd

#reading in raw data through pandas read_csv command
playing_pos_data = pd.read_csv('PlayerPlayingPositionData.csv')
print(playing_pos_data)

#extract total number of rows for iteration
total_rows = playing_pos_data.shape[0]

#create new .sql file to run on sql to insert table
f = open("attack.sql","w")
print("DROP TABLE IF EXISTS Attack; \nCREATE TABLE Attack(Player_id INT, CF INT, LF INT, LS INT, LW INT, RF INT, RS INT, RW INT, ST INT);\n", file=f)

for i in range(0,total_rows):
	print("INSERT into Attack values (", playing_pos_data["ID"][i], ", ", playing_pos_data["CF"][i], ", ", playing_pos_data["LF"][i], ", ", playing_pos_data["LS"][i], ", ", playing_pos_data["LW"][i], ", ", playing_pos_data["RF"][i], ", ", playing_pos_data["RS"][i], ", ", playing_pos_data["RW"][i], ", ", playing_pos_data["ST"][i], ");",sep="", file=f)

f.close()