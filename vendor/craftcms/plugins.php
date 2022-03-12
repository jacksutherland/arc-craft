<?php

$vendorDir = dirname(__DIR__);
$rootDir = dirname(dirname(__DIR__));

return array (
  'realitygems/arc' => 
  array (
    'class' => 'realitygems\\arc\\ARC',
    'basePath' => $vendorDir . '/realitygems/arc/src',
    'handle' => 'arc',
    'aliases' => 
    array (
      '@realitygems/arc' => $vendorDir . '/realitygems/arc/src',
    ),
    'name' => 'ARC',
    'version' => '1.0.0',
    'description' => 'Custom Plugin for ARCollective Website',
    'developer' => 'RealityGems',
    'developerUrl' => 'https://realitygems.com',
    'documentationUrl' => '???',
    'changelogUrl' => '???',
    'components' => 
    array (
      'member' => 'realitygems\\arc\\services\\Member',
    ),
  ),
  'mmikkel/reasons' => 
  array (
    'class' => 'mmikkel\\reasons\\Reasons',
    'basePath' => $vendorDir . '/mmikkel/reasons/src',
    'handle' => 'reasons',
    'aliases' => 
    array (
      '@mmikkel/reasons' => $vendorDir . '/mmikkel/reasons/src',
    ),
    'name' => 'Reasons',
    'version' => '2.2.6',
    'description' => 'Adds conditionals to field layouts.',
    'developer' => 'Mats Mikkel Rummelhoff',
    'developerUrl' => 'https://vaersaagod.no',
    'documentationUrl' => 'https://github.com/mmikkel/Reasons-Craft3/blob/master/README.md',
    'changelogUrl' => 'https://github.com/mmikkel/Reasons-Craft3/blob/master/CHANGELOG.md',
  ),
  'verbb/super-table' => 
  array (
    'class' => 'verbb\\supertable\\SuperTable',
    'basePath' => $vendorDir . '/verbb/super-table/src',
    'handle' => 'super-table',
    'aliases' => 
    array (
      '@verbb/supertable' => $vendorDir . '/verbb/super-table/src',
    ),
    'name' => 'Super Table',
    'version' => '2.7.1',
    'description' => 'Super-charge your Craft workflow with Super Table. Use it to group fields together or build complex Matrix-in-Matrix solutions.',
    'developer' => 'Verbb',
    'developerUrl' => 'https://verbb.io',
    'developerEmail' => 'support@verbb.io',
    'documentationUrl' => 'https://github.com/verbb/super-table',
    'changelogUrl' => 'https://raw.githubusercontent.com/verbb/super-table/craft-3/CHANGELOG.md',
  ),
  'craftcms/redactor' => 
  array (
    'class' => 'craft\\redactor\\Plugin',
    'basePath' => $vendorDir . '/craftcms/redactor/src',
    'handle' => 'redactor',
    'aliases' => 
    array (
      '@craft/redactor' => $vendorDir . '/craftcms/redactor/src',
    ),
    'name' => 'Redactor',
    'version' => '2.10.5',
    'description' => 'Edit rich text content in Craft CMS using Redactor by Imperavi.',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'developerEmail' => 'support@craftcms.com',
    'documentationUrl' => 'https://github.com/craftcms/redactor/blob/v2/README.md',
  ),
);
