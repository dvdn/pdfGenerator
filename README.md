README
======

What is pdf-generator ?
------------------

Simple webservice to generate pdf from html using library wkhtml library.
Basically there is only one file in this project, it takes in parameter an url and directly outputs the pdf content in the answer.

Installation
-------------

1. Package wkhtml : C++ lib which converts html into pdf. Uses WebKit as render engine.
sudo apt-get install wkhtmltopdf

2. Package xvfb : X Server used by wkhtmltopdf.
sudo apt-get install xvfb

3. Get project on git
git clone http://hg.prod.canaltp.fr/ctp/pdfGenerator.git

5. Run composer
composer.phar install

4. Use it!

Requirements
-------------

knplabs/knp-snappy: https://github.com/KnpLabs/snappy

Usage
-------------

call index.php and give in parameter the url to convert into pdf.

Example (without vhost):
http://localhost/pdfGenerator/web/index.php?url=www.example.org

Remarks
-------------

By default there is no javascript to minimize resources consumption.

TODO
-------------

Securize this webservice using apache vhost, limit to a specific range of ip for instance.

Contributing
-------------

1. Vincent Degroote - vincent.degroote@canaltp.fr