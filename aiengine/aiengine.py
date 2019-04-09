import time
import pickle
import mysql.connector
import re
modelFileHandler = open("farmerTextClassifier.nbm", 'rb')
farmerTextClassifier = pickle.load(modelFileHandler)

def totalPos(texts):
    pos = 0
    totalPosts=0
    for i in texts:
        totalSentences = 0
        hi = 0
        sentenceList = re.split(r' *[\.\?!][\'"\)\]]* *', i)
        while '' in sentenceList:
            sentenceList.remove('')
        print(sentenceList)
        for sentence in sentenceList:
            sentence = str(sentence)
            sentence=sentence+"."
            sentence = sentence.lstrip("\r\n")
            sentence = sentence.lstrip("\n")
            sentence = sentence.lower()
            x = (farmerTextClassifier.prob_classify(sentence)).prob("pos")
            if(x >= 0.35):
                hi=hi+1
            print(x)
            totalSentences = totalSentences + 1
        if hi/totalSentences >= 0.35:
            print("Total sentences: " + str(totalSentences)+", in: " + i)
            pos = pos+1
        totalPosts=totalPosts+1
        print("Total posts: " + str(totalPosts))
    return (pos,totalPosts)

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="thefarmershub"
)

mycursor = mydb.cursor()

while(True):
    sql = "SELECT qtext FROM question"
    mycursor.execute(sql)
    myresult=mycursor.fetchall()
    texts = []
    for i in myresult:
        texts.append(i[0])
    print(texts)
    questionAnalysisResult = totalPos(texts)

    sql = "SELECT atext FROM answer"
    mycursor.execute(sql)
    myresult=mycursor.fetchall()
    texts = []
    for i in myresult:
        texts.append(i[0])
    print(texts)
    answerAnalysisResult = totalPos(texts)

    sql = "SELECT text FROM article"
    mycursor.execute(sql)
    myresult=mycursor.fetchall()
    texts = []
    for i in myresult:
        texts.append(i[0])
    print(texts)
    articleAnalysisResult = totalPos(texts)

    sql = "SELECT ctext FROM comment"
    mycursor.execute(sql)
    myresult=mycursor.fetchall()
    texts = []
    for i in myresult:
        texts.append(i[0])
    print(texts)
    commentAnalysisResult = totalPos(texts)

    print(questionAnalysisResult);
    print(answerAnalysisResult);
    print(articleAnalysisResult);
    print(commentAnalysisResult);

    sql = "INSERT INTO statistics(qpc, apc, arpc, cpc, totalquestions, totalanswers, totalarticles, totalcomments) VALUES ("
    sql += str(questionAnalysisResult[0])+","+str(answerAnalysisResult[0])+","+str(articleAnalysisResult[0])+","+str(commentAnalysisResult[0])+","
    sql += str(questionAnalysisResult[1])+","+str(answerAnalysisResult[1])+","+str(articleAnalysisResult[1])+","+str(commentAnalysisResult[1])
    sql += ")"

    mycursor.execute(sql)
    mydb.commit()
    time.sleep(30)
