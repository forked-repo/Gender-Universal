# Gender Universal

Detects gender from person's name, capable to analyse strings in these scripts: Latin, Cyrillic, Hanzi (Kanji).

## Dependencies

* [peterkahl\charset-from-string](https://github.com/peterkahl/Charset-From-String)
* [peterkahl\gender-hanzi](https://github.com/peterkahl/Gender-Hanzi)
* [peterkahl\gender-latin](https://github.com/peterkahl/Gender-Latin)
* [peterkahl\gender-cyrillic](https://github.com/peterkahl/Gender-Cyrillic)

## Usage

```php
use peterkahl\GenderUniversal\GenderUniversal;

$gendObj = new GenderUniversal;

#-------------------------------
# French (Latin) name
$gendObj->firstName = 'Gaétan';
$gendObj->lastName  = '';         # Surname is irrelevant (in this case)
$gendObj->country   = 'FR';       # Country code may be helpful

echo $gendObj->getGender(); # M

#-------------------------------
# Russian (Cyrillic) name
$gendObj->firstName = 'Алла';
$gendObj->lastName  = 'Пугачёва'; # Surname may be helpful
$gendObj->country   = '';

echo $gendObj->getGender(); # F

#-------------------------------
# Chinese (Hanzi) name
$gendObj->firstName = '澤東';      # Make sure this is only given name (not surname)
$gendObj->lastName  = '';         # Surname is irrelevant (in this case)
$gendObj->country   = '';         # Country code is irrelevant (in this case)

echo $gendObj->getGender(); # M

#-------------------------------
# Japanese (Kanji) name
$gendObj->firstName = '喜孝';      # Make sure this is only given name (not surname)
$gendObj->lastName  = '';         # Surname is irrelevant (in this case)
$gendObj->country   = '';         # Country code is irrelevant (in this case)

echo $gendObj->getGender(); # M
```
