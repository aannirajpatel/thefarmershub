import re
file_to_read = 'data.neg'

with open(file_to_read) as f:
    text = f.read()

x = re.split(r' *[\.\?!][\'"\)\]]* *', text)
trainNeg = []
for p in x:
    p = str(p)
    p=p+"."
    p = p.lstrip("\n")
    print(p)
    trainNeg.append(p)

file_to_read = 'data.pos'

with open(file_to_read) as f:
    text = f.read()

x = re.split(r' *[\.\?!][\'"\)\]]* *', text)
trainNeg = []
for p in x:
    p = str(p)
    p=p+"."
    p = p.lstrip("\n")
    print(p)
    trainNeg.append(p)


