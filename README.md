LanguageInflection
====
This MediaWiki extension provides inflection for language names in specific languages.

Extending the list of supported languages
----
You can extend the code so that it would support the desired language. Specific classes are placed in /languages/ directory under name mask LanguageInflection<langcode>.php, where <langcode> is the language code supported by MediaWiki. (Note: dashes "-" should be replaced by underscores "_", for example: the file name for language <be-tarask> should appear as LanguageInflectionBe_tarask.php.)
