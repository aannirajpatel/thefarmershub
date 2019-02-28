char = 0
while(!eof){
do
	char = read_next(file)
	i++
	str[i]=char;
while(char!="." && !eof);
}