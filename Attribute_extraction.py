#Please run this code with the command python3 Attribute_extraction.py

#import pandas library
import pandas as pd

#read in PlayerAttributeData.csv file into pandas dataframe
attribute_data = pd.read_csv('PlayerAttributeData.csv', low_memory=False)

#code to test if csv file was read in
#print(attribute_data)

#get the total number of rows and cols
total_rows = attribute_data.shape[0]
total_cols = attribute_data.shape[1]


#create new sql file, attribute.sql and write to it the commands necessary to populate data this sql file will be run later
f = open("attribute.sql", "w")
print("DROP TABLE IF EXISTS Attributes; \nCREATE TABLE Attributes (ID INT, Acceleration INT, Aggression INT, Agility INT, Balance INT, Ball_control INT, Composure INT, Crossing INT, Curve INT, Dribbling INT, Finishing INT, Free_kick_accuracy INT, GK_diving INT, GK_handling INT, GK_kicking INT, GK_positioning INT, GK_reflexes INT, Heading_accuracy INT, Interceptions INT, Jumping INT, Long_passing INT, Long_shots INT, Marking INT, Penalties INT, Positioning INT, Reactions INT, Short_passing INT, Shot_power INT, Sliding_tackle INT, Sprint_speed INT, Stamina INT, Standing_tackle INT, Strength INT, Vision INT, Volleys INT);\n", file=f)

for i in range(0,total_rows):
	print("INSERT into Attributes values (", attribute_data["ID"][i], ", ", eval(str(attribute_data["Acceleration"][i])), ", ", eval(str(attribute_data["Aggression"][i])), ", ", eval(str(attribute_data["Agility"][i])), ", ", eval(str(attribute_data["Balance"][i])), ", ", eval(str(attribute_data["Ball control"][i])), ", ", eval(str(attribute_data["Composure"][i])), ", ", eval(str(attribute_data["Crossing"][i])), ", ", eval(str(attribute_data["Curve"][i])), ", ", eval(str(attribute_data["Dribbling"][i])), ", ", eval(str(attribute_data["Finishing"][i])), ", ", eval(str(attribute_data["Free kick accuracy"][i])), ", ", eval(str(attribute_data["GK diving"][i])), ", ", eval(str(attribute_data["GK handling"][i])), ", ", eval(str(attribute_data["GK kicking"][i])), ", ", eval(str(attribute_data["GK positioning"][i])), ", ", eval(str(attribute_data["GK reflexes"][i])), ", ", eval(str(attribute_data["Heading accuracy"][i])), ", ", eval(str(attribute_data["Interceptions"][i])), ", ", eval(str(attribute_data["Jumping"][i])), ", ", eval(str(attribute_data["Long passing"][i])), ", ", eval(str(attribute_data["Long shots"][i])), ", ", eval(str(attribute_data["Marking"][i])), ", ", eval(str(attribute_data["Penalties"][i])), ", ", eval(str(attribute_data["Positioning"][i])), ", ", eval(str(attribute_data["Reactions"][i])), ", ", eval(str(attribute_data["Short passing"][i])), ", ", eval(str(attribute_data["Shot power"][i])), ", ", eval(str(attribute_data["Sliding tackle"][i])), ", ", eval(str(attribute_data["Sprint speed"][i])), ", ", eval(str(attribute_data["Stamina"][i])), ", ", eval(str(attribute_data["Standing tackle"][i])), ", ", eval(str(attribute_data["Strength"][i])), ", ", eval(str(attribute_data["Vision"][i])), ", ", eval(str(attribute_data["Volleys"][i])),");",sep="", file=f)
f.close()
