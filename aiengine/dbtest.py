import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="thefarmershub"
)

print(mydb)

mycursor = mydb.cursor()

a=0
b=0
c=0
d=0
e=0
sql = """INSERT INTO statistics (qhi, ahi, arhi, comhi,totusers) VALUES (%s, %s,%s,%s,%s)"""
val = (a,b,c,d,e)

mycursor.execute(sql,(a,b,c,d,e))
mydb.commit()

print(mycursor.rowcount, "record inserted.")

sql = "SELECT qtext FROM question"
mycursor.execute(sql)
myresult=mycursor.fetchall()
qs = []
for i in myresult:
    qs.append(i[0])
print(qs)
