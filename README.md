# TheFarmersHub
>A multilingual forum with sentiment analysis for helping Indian farmers

## Features!
1. A multi-lingual QnA platform made using PHP, MySQL, Bootstrap and Google Translate API
2. Sentiment Analysis Engine (uses a Naive Bayes classifier) written in Python
3. Sentiment Analysis Dashboard made using Chart.js - provides stats about farmers' mental health

## AI Engine Dashboard Screenshots
Please open the pdf file in the root directory

## Steps to run:

1. Start `XAMPP` server, `APACHE` and `MySQL` services
2. Load the database (thefarmershub `dbv3.sql`) into `MySQL`
3. Run `aiengine/modelTrainer.py` to get the file `farmerTextClassifier.nbm`
4. Start `aiengine/aiengine.py` (`Python 3.6+` must be installed!)
5. Open web browser, and enter URL `localhost/thefarmershub/login.php`
6. ENJOY!
