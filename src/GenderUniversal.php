<?php
/**
 * Gender Universal
 * Detects gender from person's name, capable to analyse strings in
 * these scripts: Latin, Cyrillic, Hanzi (Kanji).
 *
 * @version    0.2 (2017-07-15 07:56:00 GMT)
 * @author     Peter Kahl <peter.kahl@colossalmind.com>
 * @since      2017-01-27
 * @license    Apache License, Version 2.0
 *
 * Copyright 2017 Peter Kahl <peter.kahl@colossalmind.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      <http://www.apache.org/licenses/LICENSE-2.0>
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace peterkahl\GenderUniversal;

use peterkahl\CharsetFromString\CharsetFromString;
use peterkahl\GenderHanzi\GenderHanzi;
use peterkahl\GenderLatin\GenderLatin;
use peterkahl\GenderCyrillic\GenderCyrillic;

use \Gender\Gender;
use \Exception;

class GenderUniversal {

  /**
   * Country code
   * @var string
   */
  public $country = '';

  /**
   * First Name: REQUIRED
   * @var string
   */
  public $firstName = '';

  /**
   * Last Name: OPTIONAL
   * @var string
   */
  public $lastName = '';

  #===================================================================

  public function getGender() {

    if (empty($this->firstName)) {
      throw new Exception('Property firstName cannot be empty');
    }

    $charset = CharsetFromString::getCharset($this->firstName . $this->lastName);

    if ($charset == 'CJK' || $charset == 'JAPANESE') {
      return GenderHanzi::getGender($this->firstName);
    }
    elseif ($charset == 'CYRILLIC') {
      return GenderCyrillic::getGender($this->firstName, $this->lastName);
    }
    elseif ($charset == 'LATIN') {
      $latGen = new GenderLatin;
      $latGen->firstName = $this->firstName;
      $latGen->lastName  = $this->lastName;
      $latGen->country   = $this->country;
      return $latGen->getGender();
    }

    # Other charsets not configured yet.
    return 'N';
  }

  #===================================================================
}
