import pandas as pd

personal_data = pd.read_csv('PersonalData.csv')
#print (personal_data)
attribute_data = pd.read_csv('PlayerAttributeData.csv',low_memory=False)
#print (attribute_data)
position_data = pd.read_csv('PlayerPlayingPositionData.csv')
#print(position_data)


personal_data.to_csv(r'personal.txt', header=None, index=None, sep=' ', mode='a')
attribute_data.to_csv(r'attribute.txt', header=None, index=None, sep=' ', mode='a')
position_data.to_csv(r'position.txt', header=None, index=None, sep=' ', mode='a')



total_rows = personal_data.shape[0]


f = open("test.sql","w")
print("DROP TABLE IF EXISTS Player; \nCREATE TABLE Player (Player_id INT, Name VARCHAR(20), Nationality VARCHAR(20), Age INT, Team VARCHAR(20), Overall INT);\n", file=f)

for i in range(0,total_rows):
	print("INSERT into Player values (", str(personal_data["ID"][i]), ", ", '"', personal_data["Name"][i], '"', ", ", '"', personal_data["Nationality"][i], '"', ", ", personal_data["Age"][i], ", ", '"', personal_data["Club"][i], '"', ", ", personal_data["Overall"][i], ");",sep="", file=f)
f.close()
