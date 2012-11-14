<?php

namespace Fortissimo\CLI\Phar;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\Adapter\PhpAdapter;

class Compiler {
  public function compile($pharFile, $name = 'foo-app', array $files = array(), array $directories = array(), $stub_file, $base_path, $name_pattern = '*.php', $strip = TRUE) {
    if (file_exists($pharFile)) {
      unlink($pharFile);
    }

    $phar = new \Phar($pharFile, 0, $name);

    // The signature is automatically set unless we decide to compress. In that
    // case we have to manually set it. Setting to the default just in case.
    $phar->setSignatureAlgorithm(\Phar::SHA1);

    $phar->startBuffering();

    // CLI Component files
    $iterator = Finder::create()->files()->name($name_pattern)->in($directories);

    // There is some strange case where the higher priority adapters are not working
    // by default but the PHP one works just fine to add all the files. So, we
    // are specifying this. Since this shouldn't be how we do this.
    // @todo fix the finder adapter.
    $iterator->removeAdapters();
    $iterator->addAdapter(new PhpAdapter());

    $files = array_merge($files, iterator_to_array($iterator));
    foreach ($files as $file) {
      $path = str_replace($base_path . '/', '', $file);

      if ($strip) {
        $phar->addFromString($path, php_strip_whitespace($file));
      }
      else {
        $phar->addFromString($path, file_get_contents($file));
      }
    }

    $phar->setStub(file_get_contents($stub_file));

    $phar->stopBuffering();

    // Not all systems support compressed Phars. For now disabling.
    // $phar->compressFiles(\Phar::GZ);

    chmod($pharFile, 0755);

    unset($phar);
  }
}
