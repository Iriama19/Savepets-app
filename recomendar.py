# -*- coding: utf-8 -*-


import pandas
# Commented out IPython magic to ensure Python compatibility.
import pandas as pd
import numpy as np
import warnings
warnings.filterwarnings("ignore")
 
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import MinMaxScaler
from sklearn.neighbors import KNeighborsClassifier
from sklearn.metrics import classification_report
from sklearn.metrics import confusion_matrix

#Read param and csv
import sys
exit
if len(sys.argv) == 2:
    usuario = sys.argv[1]
else:
    print("Error - Introduce los argumentos correctamente")


dataframe = pd.read_csv(r"history.csv",sep=',')

my_cols = set(dataframe.columns)
#Prepare data
# removing the undesired column
my_cols.remove('NumPublicationStray')
my_cols.remove('NumPublicationHelp')
my_cols.remove('NumPublicationAdoption')
my_cols.remove('User_City')
my_cols.remove('User_Province')
my_cols.remove('User_PostalCode')
my_cols.remove('AnimalShelter')

#Fill nan
my_cols = list(my_cols)
df = dataframe[my_cols]
df["Gender"].fillna("Unknown", inplace = True)
df["Marital Status"].fillna("Unknown", inplace = True)
df["Housing"].fillna("Unknown", inplace = True)
df["Work"].fillna("Unknown", inplace = True)
df["Studies"].fillna("Unknown", inplace = True)
df["Other Pets"].fillna("Unknown", inplace = True)

df["Specie"].fillna("Unknown", inplace = True)
df["Chip"].fillna("Unknown", inplace = True)
df["Sex"].fillna("Unknown", inplace = True)
df["Race"].fillna("Unknown", inplace = True)
df["Age"].fillna(0, inplace = True)
df["State"].fillna("Unknown", inplace = True)
df["NumPets"].fillna("Unknown", inplace = True)
df["Children"].fillna(0, inplace = True)

#Pass values to number
df["Model"]  = np.where(df["Model"] == 'Animal' , 0, np.where(df["Model"] == 'PublicationHelp' , 1, np.where(df["Model"] == 'PublicationAdoption' , 2,np.where(df["Model"] == 'PublicationStray' , 3,np.where(df["Model"] == 'PublicationStrayAddress' , 4,np.where(df["Model"] == 'Event' , 5,np.where(df["Model"] == 'Comment' , 6,7)))))))
df['Chip'] = (df['Chip'] == 'yes').astype(int)
df["Marital Status"]  = np.where(df["Marital Status"] == 'single' , 0, np.where(df["Marital Status"] == 'married' , 1, np.where(df["Marital Status"] == 'divorced' , 2,np.where(df["Marital Status"] == 'separated' , 3, np.where(df["Marital Status"] == 'relationship' , 4, 5)))))
df["Sex"]  = np.where(df["Sex"] == 'intact_female' , 0, np.where(df["Sex"] == 'intact_male' , 1, np.where(df["Sex"] == 'neutered_female' , 2,np.where(df["Sex"] == 'castrated_male' , 3, np.where(df["Sex"] == 'unknow' , 4, 4)))))
df["Housing"]  = np.where(df["Housing"] == 'detached house' , 0, np.where(df["Housing"] == 'semi-detached house' , 1, np.where(df["Housing"] == 'terraced house' , 2,np.where(df["Housing"] == 'bungalows' , 3, np.where(df["Housing"] == 'studio' , 4, np.where(df["Housing"] == 'apartment' , 5, np.where(df["Housing"] == 'flat' , 6, np.where(df["Housing"] == 'attic' , 7,  np.where(df["Housing"] == 'ground floor' , 8, np.where(df["Housing"] == 'ground floor with garden' , 9, np.where(df["Housing"] == 'loft' , 10, np.where(df["Housing"] == 'duplex' , 11,  np.where(df["Housing"] == 'triplex' , 12, np.where(df["Housing"] == 'quadplex' , 14, 14))))))))))))))
df["Gender"]  = np.where(df["Gender"] == 'male' , 0, np.where(df["Gender"] == 'female' , 1, np.where(df["Gender"] == 'nobinary' , 2,3)))
#df["Specie"]  = np.where(df["Specie"] == 'cat' , 0, np.where(df["Specie"] == 'dog' , 1, np.where(df["Specie"] == 'bunny' , 2,np.where(df["Specie"] == 'hamster' , 3,np.where(df["Specie"] == 'snake' , 4,np.where(df["Specie"] == 'turtles' , 5,6))))))
df["Other Pets"]  = np.where(df["Other Pets"] == 'cat' , 0, np.where(df["Other Pets"] == 'dog' , 1, np.where(df["Other Pets"] == 'bunny' , 2,np.where(df["Other Pets"] == 'hamster' , 3,np.where(df["Other Pets"] == 'snake' , 4,np.where(df["Other Pets"] == 'turtles' , 5,np.where(df["Other Pets"] == 'several' , 6,7)))))))
df["State"]  = np.where(df["State"] == 'healthy' , 0, np.where(df["State"] == 'sick' , 1, np.where(df["State"] == 'adopted' , 2,np.where(df["State"] == 'dead' , 3,np.where(df["State"] == 'foster' , 4,np.where(df["State"] == 'other' , 5,6))))))

cols = df.columns.tolist()
cols=['Username', 'Model', 'UserAge', 'Gender', 'User_Country', 'Housing', 'Work', 'Studies', 'Children', 'Marital Status',  'Other Pets', 'NumPets', 'Numpublication', 'NumComment', 'NumPets', 'Specie', 'Race', 'Sex','Age', 'State', 'Chip']
df = df[cols]

#Tokenize
from nltk.tokenize import word_tokenize 
from nltk.corpus import stopwords
from nltk.stem import PorterStemmer

import nltk
#nltk.download('punkt')
nltk.download('stopwords')

ps = PorterStemmer()

preprocessedText = []

for row in df.itertuples():
        text = word_tokenize(row[5]) ## indice de la columna que contiene el texto
        text += ' '
        text += word_tokenize(row[7]) ## indice de la columna que contiene el texto
        text += ' '
        text += word_tokenize(row[8]) ## indice de la columna que contiene el texto
        text += ' '
        text += word_tokenize(row[16]) ## indice de la columna que contiene el texto
        text += ' '
        text += word_tokenize(row[17]) ## indice de la columna que contiene el texto

        ## Remove stop words
        stops = set(stopwords.words("spanish"))
        text = [ps.stem(w) for w in text if not w in stops and w.isalnum()]
        text = " ".join(text)

        preprocessedText.append(text)

preprocessedData = df
preprocessedData['Keywords'] = preprocessedText

from sklearn.feature_extraction.text import TfidfVectorizer

bagOfWordsModel = TfidfVectorizer()
bagOfWordsModel.fit(preprocessedData['Keywords'])
textsBoW = bagOfWordsModel.transform(preprocessedData['Keywords'])

#Distance

from sklearn.metrics import pairwise_distances

distance_matrix= pairwise_distances(textsBoW,textsBoW ,metric='cosine')


#Matriz a csv(preprocessedData)

searchUsername = usuario
indexOfUsername = preprocessedData[preprocessedData['Username']==searchUsername].index.values[0]

distance_scores = list(enumerate(distance_matrix[indexOfUsername]))

ordered_scores = sorted(distance_scores, key=lambda x: x[1])

top_scores = ordered_scores[1:4]

top_indexes = [i[0] for i in top_scores]

#Get values
animalagereccomend=preprocessedData['Age'].iloc[top_indexes]

animalagereccomend=str(animalagereccomend)
animalagereccomend = animalagereccomend.split("\n")

animalagereccomend1=animalagereccomend[0]
animalagereccomend1=animalagereccomend1.split(".")
animalagereccomend1=animalagereccomend1[0]
animalagereccomend1=" ".join(animalagereccomend1.split())
animalagereccomend1 = animalagereccomend1.replace(" ",",")

animalagereccomend2=animalagereccomend[1]
animalagereccomend2=animalagereccomend2.split(".")
animalagereccomend2=animalagereccomend2[0]
animalagereccomend2=" ".join(animalagereccomend2.split())
animalagereccomend2 = animalagereccomend2.replace(" ",",")

animalagereccomend3=animalagereccomend[2]
animalagereccomend3=animalagereccomend3.split(".")
animalagereccomend3=animalagereccomend3[0]
animalagereccomend3=" ".join(animalagereccomend3.split())
animalagereccomend3 = animalagereccomend3.replace(" ",",")


animalspeciereccomend=preprocessedData['Specie'].iloc[top_indexes]
animalspeciereccomend=str(animalspeciereccomend)
animalspeciereccomend = animalspeciereccomend.split("\n")

animalspeciereccomend1=animalspeciereccomend[0]
animalspeciereccomend1=" ".join(animalspeciereccomend1.split())
animalspeciereccomend1 = animalspeciereccomend1.replace(" ",",")

animalspeciereccomend2=animalspeciereccomend[1]
animalspeciereccomend2=" ".join(animalspeciereccomend2.split())
animalspeciereccomend2 = animalspeciereccomend2.replace(" ",",")

animalspeciereccomend3=animalspeciereccomend[2]
animalspeciereccomend3=" ".join(animalspeciereccomend3.split())
animalspeciereccomend3 = animalspeciereccomend3.replace(" ",",")

animalracereccomend=preprocessedData['Race'].iloc[top_indexes]
animalracereccomend=str(animalracereccomend)
animalracereccomend = animalracereccomend.split("\n")

animalracereccomend1=animalracereccomend[0]

animalracereccomend1=" ".join(animalracereccomend1.split())
animalracereccomend1 = animalracereccomend1.replace(" ",",")
animalracereccomend1=list(animalracereccomend1.split(","))
animalracereccomend1=animalracereccomend1[1]

animalracereccomend2=animalracereccomend[1]
animalracereccomend2=" ".join(animalracereccomend2.split())
animalracereccomend2 = animalracereccomend2.replace(" ",",")
animalracereccomend2=list(animalracereccomend2.split(","))
animalracereccomend2=animalracereccomend2[1]
    
animalracereccomend3=animalracereccomend[2]
animalracereccomend3=" ".join(animalracereccomend3.split())
animalracereccomend3 = animalracereccomend3.replace(" ",",")
animalracereccomend3=list(animalracereccomend3.split(","))
animalracereccomend3=animalracereccomend3[1]
    
animalrecomendacion=animalagereccomend1+','+animalagereccomend2+','+animalagereccomend3+','+animalspeciereccomend1+','+animalspeciereccomend2+','+animalspeciereccomend3+','+animalracereccomend1+','+animalracereccomend2+','+animalracereccomend3

animalrecomendacion=animalrecomendacion.split(",")
resultado=[]

resultado.append(animalrecomendacion[1])
resultado.append(animalrecomendacion[3])
resultado.append(animalrecomendacion[5])
resultado.append(animalrecomendacion[7])
resultado.append(animalrecomendacion[9])
resultado.append(animalrecomendacion[11])
resultado.append(animalrecomendacion[12])
resultado.append(animalrecomendacion[13])
resultado.append(animalrecomendacion[14])

print(resultado[0]+','+resultado[1]+','+resultado[2]+','+resultado[3]+','+resultado[4]+','+resultado[5]+','+resultado[6]+','+resultado[7]+','+resultado[8])