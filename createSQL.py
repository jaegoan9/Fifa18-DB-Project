import pandas as pd
import collections

personal_data = pd.read_csv('PlayerPersonalData.csv')
attribute_data = pd.read_csv('PlayerAttributeData.csv')
position_data = pd.read_csv('PlayerPlayingPositionData.csv')
country_data = pd.read_csv('og-country-codes.csv')

personal_total_rows = personal_data.shape[0]
# player_file = open('player.sql', 'w')
#
# player_file.write("DROP TABLE IF EXISTS Player; \nCREATE TABLE Player (Player_id INT, Name VARCHAR(20), "
#                   "Nationality VARCHAR(20), Age INT, Team VARCHAR(20), Overall INT);\n\n")
#
# for i in range(personal_total_rows):
#     player_file.write("INSERT into Player values (" + str(personal_data["ID"][i]) + ", " + '"'
#                       + str(personal_data["Name"][i]) + '"' + ", " + '"' + str(personal_data["Nationality"][i]) + '"'
#                       + ", " + str(personal_data["Age"][i]) + ", " + '"' + str(personal_data["Club"][i]) + '"' + ", "
#                       + str(personal_data["Overall"][i]) + ");\n")
#
# player_file.close()

country = []
country_dic = {}
row = country_data.shape[0]
for i in range(1,row):
    country.append(country_data["official_name_en"][i])
    country_dic[country_data["official_name_en"][i]] = country_data["FIFA"][i]

nationality = []
row2 = personal_data.shape[0]
for i in range(row2):
    nationality.append(personal_data["Nationality"][i])

myset = set(nationality)
nationality = list(myset)

matched_country = []
matched_nationality = []
counter = 0
abv = {}
for i in range(len(nationality)):
    for j in range(len(country)):
        if nationality[i] == country[j]:
            matched_country.append(country[j])
            matched_nationality.append(nationality[i])
            abv[nationality[i]] = country_dic[country[j]]

not_nationality = []
for i in range(len(nationality)):
    if nationality[i] not in matched_nationality:
        not_nationality.append(nationality[i])

abv["Palestine"] = "PLE"
abv["Bolivia"] = "BOL"
abv["Republic of Ireland"] = "IRL"
abv["Korea DPR"] = "PRK"
abv["FYR Macedonia"] = "MKD"
abv["DR Congo"] = "COD"
abv["Tanzania"] = "TAN"
abv["St Kitts Nevis"] = "SKN"
abv["England"] = "ENG"
abv["Kosovo"] = "RKS"
abv["Czech Republic"] = "CZE"
abv["Korea Republic"] = "KOR"
abv["United States"] = "USA"
abv["Russia"] = "RUS"
abv["Antigua & Barbuda"] = "ATG"
abv["Vietnam"] = "VIE"      # Not in the country-codes excel file
abv["Scotland"] = "SCT"
abv["Cape Verde"] = "CPV"
abv["Ivory Coast"] = "CIV"
abv["Wales"] = "WAL"
abv["Iran"] = "IRN"
abv["Hong Kong"] = "HKG"
abv["China PR"] = "CHN"
abv["Guinea Bissau"] = "GNB"
abv["Moldova"] = "MDA"
abv[not_nationality[25]] = "STP"
abv["Curacao"] = "CUW"
abv["Bosnia Herzegovina"] = "BIH"
abv["Venezuela"] = "VEN"
abv["Central African Rep."] = "CTA"
abv["Trinidad & Tobago"] = "TRI"
abv["St Lucia"] = "LCA"
abv["Syria"] = "SYR"
abv["Northern Ireland"] = "NIR"


# alph_abv = collections.OrderedDict
# alph_abv['Syria'] = 'SYR'
# for key, value in sorted(abv.items()):
#     # print key, value
#     alph_abv[key] = value
#
# print alph_abv

# for i in range(len(country)):
#     if country[i] not in matched_country:
#         print country[i]


