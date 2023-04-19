<?php declare(strict_types = 1);

include __DIR__ . '/../vendor/autoload.php';

// php src/1memoryStorage.php & php src/1memoryStorage.php & wait

$storage = new \Symfony\Component\Lock\Store\InMemoryStore();
$key = new \Symfony\Component\Lock\Key('key');
$lockFactory = new \Symfony\Component\Lock\LockFactory($storage);

$lock = $lockFactory->createLockFromKey($key);
if ($lock->acquire()) {
    echo "Lock\n";

    $lock->release();
    echo "Release\n";
}
