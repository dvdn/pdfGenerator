README
======

What is pdf-generator ?
------------------

Simple webservice to generate pdf from html using wkhtml library.
Basically there is only one file in this project, it takes in parameter an url and directly outputs the pdf content in the answer.

Installation
-------------

1. Package wkhtml : C++ lib which converts html into pdf. Uses WebKit as render engine.
sudo apt-get install wkhtmltopdf

2. Package xvfb : X Server used by wkhtmltopdf.
sudo apt-get install xvfb

3. _(OPTIONNAL)_ Package Ghostscript : Ghostscript is mandatory for option cmyk=1 (CMYK pdf output)
sudo apt-get install ghostscript

4. Get project on git
git clone http://hg.prod.canaltp.fr/ctp/pdfGenerator.git

5. Run composer
composer.phar install

6. Use it!

Requirements
-------------

knplabs/knp-snappy: https://github.com/KnpLabs/snappy

Usage
-------------

Call index.php and give in parameter the url to convert into pdf.
Example (without vhost):

``http://localhost/pdfGenerator/web/index.php?url=http://www.example.org``

You can also omit the scheme (AKA the protocol)

``http://localhost/pdfGenerator/web/index.php?url=google.fr``

If your url contains GET parameters, you need to encode it (using encodeURIComponent for instance) so it will look like this

``http://localhost/pdfGenerator/web/index.php?url=https%3A%2F%2Fwww.phpbb.com%2Fabout%2Ffeatures%2F%3Ffrom%3Dsubmenu``

Wkhtml has many parameters to refine the pdf generation as you can see here:

``http://madalgo.au.dk/~jakobt/wkhtmltoxdoc/wkhtmltopdf-0.9.9-doc.html``

All these parameters may be sent to the webservice:

``http://localhost/pdfGenerator/web/index.php?url=google.fr&orientation=landscape&zoom=2``

Options
-------------

Optionnal url get parameters could be sent to pdfGenerator:

* __margin__ : Will set CSS document sheet margin
* __cmyk__ : When set to 1 or True, the returned pdf will use CMYK colorspace (usefull for offset or Web professionnal printers)
* __ddl__ : Will force your browser to download the file. The value of the parameter will be the name of the downloaded file.

Additionnaly all wkhtmltopdf options are available (See http://wkhtmltopdf.org/usage/wkhtmltopdf.txt)
Several options have an overloaded default value :

* __lowquality__ : false
* __disable-javascript__ : true
* __disable-smart-shrinking__ : true
* __print-media-type__ : true

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
