# TheFarmersHub
>A multilingual forum with sentiment analysis for helping Indian farmers

## Features!
1. A multi-lingual QnA platform made using PHP, MySQL, Bootstrap and Google Translate API
2. Sentiment Analysis Engine (uses a Naive Bayes classifier) written in Python
3. Sentiment Analysis Dashboard made using Chart.js - provides stats about farmers' mental health

## AI Engine Dashboard Screenshots
Please open the pdf file in the root directory: https://github.com/aannirajpatel/thefarmershub/blob/master/screencapture-localhost-thefarmershub-statistics-statistics-php-2019-03-24-11_09_57.pdf

## Steps to deploy

1. You will need `XAMPP`. Download and follow the straightforward instructions from here: [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)
2. Start `XAMPP` server, `APACHE` and `MySQL` services, make sure the website folder is in your `xampp/htdocs` folder
3. Load the database (`thefarmershub/dbv3.sql`) into `MySQL`, by going to the `Import` tab in `localhost/phpmyadmin`.
4. Install the latest Python 3 distro ([from here](https://www.python.org/downloads/)), then do the following on your command line (CMD/Bash/Terminal):
>`pip install -U textblob`<br>
>`python -m textblob.download_corpora`
5. Run `aiengine/modelTrainer.py` to get the Naive Bayes Model file `farmerTextClassifier.nbm`
6. Start `aiengine/aiengine.py` (`Python 3.6+` must be installed!)
7. Open web browser, and enter URL `localhost/thefarmershub/login.php`
8. ENJOY!
