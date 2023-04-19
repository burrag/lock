<?php declare(strict_types = 1);

include __DIR__ . '/../vendor/autoload.php';

// php src/2redisBlockingStorage.php & php src/2redisBlockingStorage.php & wait

$client = new \Predis\Client('tcp://redis:6379');
$storage = new \Symfony\Component\Lock\Store\RedisStore($client);
$key = new \Symfony\Component\Lock\Key('key');
$lockFactory = new \Symfony\Component\Lock\LockFactory($storage);

$lock = $lockFactory->createLockFromKey($key);
if ($lock->acquire(true)) {
    echo "Lock\n";

    sleep(10);
    $lock->release();

    echo "Release\n";
}
