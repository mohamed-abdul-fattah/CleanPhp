<?php

use Peridot\Plugin\Prophecy\ProphecyPlugin;
use Peridot\Plugin\Watcher\WatcherPlugin;
use Evenement\EventEmitterInterface;

return function(EventEmitterInterface $emitter) {
  $watcher = new WatcherPlugin($emitter);
  $watcher->track(__DIR__ . '/app');

  new ProphecyPlugin($emitter);
};
