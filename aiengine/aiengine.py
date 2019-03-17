import re

trainingSet = []

#Add negative sentences to the trainingSet[]
file_to_read = 'trainingData.neg'
with open(file_to_read) as f:
    text = f.read()
x = re.split(r' *[\.\?!][\'"\)\]]* *', text)
for p in x:
    p = str(p)
    p=p+"."
    p = p.lstrip("\n")
    trainingSet.append( (p,"neg") )
    f.close()

#Add positive sentences to the trainingSet[]
file_to_read = 'trainingData.pos'
with open(file_to_read) as f:
    text = f.read()
x = re.split(r' *[\.\?!][\'"\)\]]* *', text)
for p in x:
    p = str(p)
    p=p+"."
    p = p.lstrip("\n")
    trainingSet.append( (p,"pos") )
    f.close()

from textblob.classifiers import NaiveBayesClassifier
farmerTextClassifier = NaiveBayesClassifier(trainingSet)
x = input("Enter any sentence: ")
print(farmerTextClassifier.classify(x))
prob_dist = farmerTextClassifier.prob_classify(x);
print("The sentence's positivity: ")
print(prob_dist.prob("pos"))
print("The sentence's negativity: ")
print(prob_dist.prob("neg"))

#testing set develop
testingSet = []

#Add negative sentences to the testingSet[]
file_to_read = 'testingData.neg'
with open(file_to_read) as f:
    text = f.read()
x = re.split(r' *[\.\?!][\'"\)\]]* *', text)
for p in x:
    p = str(p)
    p=p+"."
    p = p.lstrip("\n")
    testingSet.append( (p,"neg") )
    f.close()

#Add positive sentences to the testingSet[]
file_to_read = 'testingData.pos'
with open(file_to_read) as f:
    text = f.read()
x = re.split(r' *[\.\?!][\'"\)\]]* *', text)
for p in x:
    p = str(p)
    p=p+"."
    p = p.lstrip("\n")
    testingSet.append( (p,"pos") )
    f.close()

#displaying the accuracy of our model
print("Accuracy: ")
print(farmerTextClassifier.accuracy(testingSet))

import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="thefarmershub"
)

mycursor = mydb.cursor()
#example for answer happiness index
ahi=0

sql = "SELECT atext FROM answer"
mycursor.execute(sql)
myresult=mycursor.fetchall()
tans = []
for i in myresult:
    tans.append(i[0])
print(tans)
tot=0
for i in tans:
    if(farmerTextClassifier.classify(i)=='pos'):
        ahi=ahi+1
    else:
        ahi=ahi-1
    tot=tot+1
print(ahi/tot)
