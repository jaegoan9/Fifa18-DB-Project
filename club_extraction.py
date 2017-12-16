import pandas as pd

personal_data = pd.read_csv('PlayerPersonalData.csv', keep_default_na=False)

personal_total_rows = personal_data.shape[0]

club = []
id_dict = {}
for i in range(personal_total_rows):
    club.append(personal_data["Club"][i])
    id_dict[personal_data["ID"][i]] = personal_data["Club"][i]

myset = set(club)
club = list(myset)

# plays_in_file = open('plays_in.sql', 'w')
#
# plays_in_file.write("DROP TABLE IF EXISTS Plays_in; \nCREATE TABLE Plays_in (Player_id INT, Club_id INT);\n\n")
#
# for i in range(personal_total_rows):
#     index = 0
#     for j in range(len(club)):
#         if id_dict[personal_data["ID"][i]] == club[j]:
#             index = j
#     plays_in_file.write("INSERT into Plays_in values (" + str(personal_data["ID"][i]) + ", " + str(index) + ");\n")
#
# plays_in_file.close()

club_file = open('club.sql', 'w')

club_file.write("DROP TABLE IF EXISTS Club; \nCREATE TABLE Club (Club_id INT, Club_name VARCHAR(40));\n\n")
for i in range(len(club)):
    club_file.write("INSERT into Club values (" + str(i) + ", " + '"' + str(club[i]) + '"' + ");\n")

club_file.close()

