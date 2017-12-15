import pandas as pd
import collections
import csv

personal_data = pd.read_csv('PlayerPersonalData.csv')
attribute_data = pd.read_csv('PlayerAttributeData.csv')
position_data = pd.read_csv('PlayerPlayingPositionData.csv')
country_data = pd.read_csv('og-country-codes.csv', keep_default_na=False)

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
fifa = []
capital = []
continent = []
developed = []
region = []
country_dic = {}
row = country_data.shape[0]
for i in range(1,row):
    country.append(country_data["official_name_en"][i])
    country_dic[country_data["official_name_en"][i]] = country_data["FIFA"][i]
    fifa.append(country_data["FIFA"][i])
    capital.append(country_data["Capital"][i])
    continent.append(country_data["Continent"][i])
    developed.append(country_data["Developed / Developing Countries"][i])
    region.append(country_data["Sub-region Name"][i])

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
abv["Wales"] = "WAL" # not in the country-codes excel file
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

alph_abv = collections.OrderedDict()
for key, value in sorted(abv.items()):
    alph_abv[key] = value

# for i in range(len(country)):
#     if country[i] not in matched_country:
#         print country[i]

country_file = open('country.csv', 'wb')
writer = csv.writer(country_file)

# index = fifa.index("AFG")
# print index
# print country[index], capital[index], continent[index], developed[index], region[index]

# print capital[233]

writer.writerow(["official_name_en"] + ["Capital"] + ["Continent"] + ["Developed / Developing Countries"]
                + ["FIFA"] + ["Sub-region Name"])
for key, value in alph_abv.items():
    if value == "WAL":
        writer.writerow([key] + ["Cardiff"] + ["EU"] + ["Developed"] + [value] + ["Northern Europe"])
    elif value == "SCT":
        writer.writerow([key] + ["Edinburgh"] + ["EU"] + ["Developed"] + [value] + ["Northern Europe"])
    elif value == "NIR":
        writer.writerow([key] + ["Belfast"] + ["EU"] + ["Developed"] + [value] + ["Northern Europe"])
    elif value == "RKS":
        writer.writerow([key] + ["Pristina"] + ["EU"] + ["Developing"] + [value] + ["Southern Europe"])
    elif value == "CUW":
        index = 57
        writer.writerow([key] + [capital[index]] + [continent[index]] + [developed[index]] + [value] + [region[index]])
    elif value == "ENG":
        index = 233
        writer.writerow([key] + [capital[index]] + [continent[index]] + [developed[index]] + [value] + [region[index]])
    else:
        index = fifa.index(value)
        writer.writerow([key] + [capital[index]] + [continent[index]] + [developed[index]] + [value] + [region[index]])

