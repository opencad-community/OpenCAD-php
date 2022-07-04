<?php

require_once(__DIR__ . '/../oc-config.php');
require_once(ABSPATH . '/oc-functions.php');
require_once(ABSPATH . '/oc-settings.php');

class PluginLoader {
  function __construct($root, $excludes = []) {
    $this->root = $root;
    $this->excludes = $excludes;
  }

  function load(...$data) {
    $data = $this->prepare($data);

    foreach($data as $name) {
      $filepath = $this->root . '/' . $name . '/index.php';
      if(!file_exists($filepath)) continue;
      if(in_array($name, $this->excludes)) continue;
      require_once $filepath;

    }
  }

  function prepare($data) {
    $includes = [];
    $excludes = [];

    $includes = $this->getIncludes($data);
    $excludes = $this->getExcludes($data);

    return array_diff($includes, $excludes);
  }

  function getIncludes($data) {
    $includes = array_filter($data, function($key) {
      return strpos($key, '!') !== 0;
    });

    if(count($includes) === 0) {
      $folders = glob($this->root . '/*', GLOB_ONLYDIR);
      foreach($folders as $folder) {
        $name = basename($folder);
        if(substr($name, 0, 1) == '_') continue;
        $includes[] = $name;
      }
    }

    return $includes;
  }

  function getExcludes($data) {
    $excludes = array_filter($data, function($key) {
      return strpos($key, '!') === 0;
    });

    foreach($excludes as $item) {
      $excludes[] = substr($item, 1);
    }

    return $excludes;
  }
}