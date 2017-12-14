import pandas as pd

personal_data = pd.read_csv('PersonalData.csv')

total_rows = personal_data.shape[0]

f = open("Value.sql","w")
