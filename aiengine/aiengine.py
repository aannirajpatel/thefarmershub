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
