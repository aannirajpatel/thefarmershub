import re
from textblob.classifiers import NaiveBayesClassifier
import pickle

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

#train and store model
farmerTextClassifier = NaiveBayesClassifier(trainingSet)
modelFileHandler = open("farmerTextClassifier.nbm", 'wb')
pickle.dump(farmerTextClassifier, modelFileHandler)

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
print("Model has been trained with accuracy: ")
print(farmerTextClassifier.accuracy(testingSet))

print("Model creation finished. Try a sentence in the prompt next or type in EXIT to terminate.\n")
while(not(x == "EXIT")):
    x = input("Try a sentence: ")
    print(farmerTextClassifier.classify(x))
    prob_dist = farmerTextClassifier.prob_classify(x)
    print("The sentence's positivity: ")
    print(prob_dist.prob("pos"))
    print("The sentence's negativity: ")
    print(prob_dist.prob("neg"))
