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
http://localhost/pdfGenerator/web/index.php?url=http://www.example.org
You can also omit the scheme (AKA the protocol)
http://localhost/pdfGenerator/web/index.php?url=google.fr
If your url contains GET parameters, you need to encode it (using encodeURIComponent for instance) so it will look like this
http://localhost/pdfGenerator/web/index.php?url=https%3A%2F%2Fwww.phpbb.com%2Fabout%2Ffeatures%2F%3Ffrom%3Dsubmenu
Wkhtml has many parameters to refine the pdf generation as you can see here: http://madalgo.au.dk/~jakobt/wkhtmltoxdoc/wkhtmltopdf-0.9.9-doc.html
All these parameters may be passed to the webservice:
http://localhost/pdfGenerator/web/index.php?url=google.fr&orientation=landscape&zoom=2

Remarks
-------------

By default there is no javascript to minimize resources consumption.You can re-enable it by setting disable-javascript to false.

TODO
-------------

Securize this webservice using apache vhost, limit to a specific range of ip for instance.

TODO?
------------
Check if the url exists and returns a valid http code?
Add an option to enable javascript if needed?

Contributing
-------------

1. Vincent Degroote - vincent.degroote@canaltp.fr