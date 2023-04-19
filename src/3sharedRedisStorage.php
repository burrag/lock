<?php declare(strict_types = 1);

include __DIR__ . '/../vendor/autoload.php';

// php src/3sharedRedisStorage.php & php src/3sharedRedisStorage.php & wait

$databaseConnectionOrDSN = 'pgsql:host=postgresql;port=5432;dbname=postgres';
$storage = new \Symfony\Component\Lock\Store\PostgreSqlStore(
    $databaseConnectionOrDSN,
    ['db_username' => 'test', 'db_password' => 'password'],
);
$key = new \Symfony\Component\Lock\Key('key');
$lockFactory = new \Symfony\Component\Lock\LockFactory($storage);

$lock = $lockFactory->createLockFromKey($key);
$lock->acquireRead();
echo "Read from source\n";

if (random_int(1, 2) === 1) { //should update?
    echo "Not acquire write lock\n";

    return;
}

echo "Will acquire write lock\n";
$lock->acquire(true);
echo "Write lock\n";
sleep(5);
$lock->release();
echo "Release\n";
