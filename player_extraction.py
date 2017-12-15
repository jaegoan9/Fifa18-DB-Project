import pandas as pd
import collections

personal_data = pd.read_csv('PlayerPersonalData.csv')
attribute_data = pd.read_csv('PlayerAttributeData.csv')
position_data = pd.read_csv('PlayerPlayingPositionData.csv')
country_data = pd.read_csv('country.csv')

country_dic = collections.OrderedDict()
country_row = country_data.shape[0]
for i in range(country_row):
    country_dic[country_data["official_name_en"][i]] = country_data["FIFA"][i]

personal_total_rows = personal_data.shape[0]
player_file = open('player.sql', 'w')

player_file.write("DROP TABLE IF EXISTS Player; \nCREATE TABLE Player (Player_id INT, Name VARCHAR(20), "
                  "Age INT, Overall INT, NTC VARCHAR(3));\n\n")

for i in range(personal_total_rows):
    temp = ""
    for key, value in country_dic.items():
        if personal_data["Nationality"][i] == key:
            temp = value
    player_file.write("INSERT into Player values (" + str(personal_data["ID"][i]) + ", " + '"'
                      + str(personal_data["Name"][i]) + '"' + ", " + '"' + str(personal_data["Age"][i]) + '"' + ", "
                      + str(personal_data["Overall"][i]) + ", " + '"' + temp + ");\n")

player_file.close()
