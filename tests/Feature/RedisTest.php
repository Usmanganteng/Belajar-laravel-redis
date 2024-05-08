<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Redis;
use Predis\Command\Argument\Geospatial\ByRadius;
use Predis\Command\Argument\Geospatial\FromLonLat;
use Tests\TestCase;

class RedisTest extends TestCase
{
    public function testPing()
    {
        $response = Redis::command("ping");
        self::assertEquals("PONG", $response);

        $response = Redis::ping();
        self::assertEquals("PONG", $response);
    }

    public function testString()
    {
        Redis::setEx("name", 2, "aldizar");
        $response = Redis::get("name");
        self::assertEquals("aldizar", $response);

        sleep(5);

        $response = Redis::get("name");
        self::assertNull($response);
    }

    public function testList() 
    {
        Redis::del("names");
        Redis::rpush("names", "muhammad");
        Redis::rpush("names", "aldizar");
        Redis::rpush("names", "ilham");

        $response = Redis::lrange("names", 0, -1);
        self::assertEquals(["muhammad", "aldizar", "ilham"], $response);

        self::assertEquals("muhammad", Redis::lpop("names"));
        self::assertEquals("aldizar", Redis::lpop("names"));
        self::assertEquals("ilham", Redis::lpop("names"));
    }
    
    public function testSet()
    {
        Redis::del("names");

        Redis::sadd("names", "muhammad");
        Redis::sadd("names", "muhammad");
        Redis::sadd("names", "aldizar");
        Redis::sadd("names", "aldizar");
        Redis::sadd("names", "ilham");
        Redis::sadd("names", "ilham");

        $response = Redis::smembers("names");
        self::assertEqualsCanonicalizing(["muhammad", "aldizar", "ilham"], $response);
    }

    public function testSortedSet()
    {
        Redis::del("names");

        Redis::zadd("names", 100, "muhammad");
        Redis::zadd("names", 100, "muhammad");
        Redis::zadd("names", 85, "aldizar");
        Redis::zadd("names", 85, "aldizar");
        Redis::zadd("names", 95, "ilham");
        Redis::zadd("names", 95, "ilham");

        $response = Redis::zrange("names", 0, -1);
        self::assertEqualsCanonicalizing(["muhammad", "aldizar", "ilham"], $response);
    }

    public function testHash()
    {
        Redis::del("user:1");

        Redis::hset("user:1", "name", "Aldizar");
        Redis::hset("user:1", "email", "aldizar@ilham");
        Redis::hset("user:1", "age", 30);

        $response = Redis::hgetall("user:1");
        self::assertEquals([
            "name" => "Aldizar",
            "email" => "aldizar@ilham",
            "age" => "30"
        ], $response);
    }

    // public function testGeoPoint()
    // {
    //     Redis::del("sellers");

    //     Redis::geoadd("sellers", 106.820990, -6.174704, "Toko A");
    //     Redis::geoadd("sellers", 106.822696, -6.176870, "Toko B");

    //     $result = Redis::geodist("sellers", "Toko A", "Toko B", "km");
    //     self::assertEquals(0.3061, $result);

    //     $result = Redis::geosearch("sellers", new FromLonLat(106.821666, -6.175494), new ByRadius(5, "km"));
    //     self::assertEquals(["Toko A", "Toko B"], $result);
    // }

    public function testGeoPoint()
    {
        Redis::del("sellers");

        Redis::geoadd("sellers", 106.820990, -6.174704, "Toko A");
        Redis::geoadd("sellers", 106.822696, -6.176870, "Toko B");

        // Menghitung jarak secara manual
        $result = Redis::geodist("sellers", "Toko A", "Toko B", "km");

        // Membandingkan jarak dalam toleransi tertentu (dalam kasus ini, hingga dua tempat desimal)
        self::assertEquals(0.31, round($result, 2));

        // Menggunakan GEORADIUS untuk mencari toko-toko dalam radius tertentu
        $radiusResult = Redis::georadius("sellers", 106.819875, -6.176091, 5, "km", "WITHDIST");
        $stores = [];
        foreach ($radiusResult as $storeInfo) {
            $stores[] = $storeInfo[0]; // Menyimpan nama toko
        }

        // Memeriksa apakah hasilnya sama dengan yang diharapkan
        self::assertEquals(["Toko B", "Toko A"], $stores);
    }

    public function testHyperLogLog()
    {
        Redis::pfadd("visitors", "muhammad", "aldizar", "ilham");
        Redis::pfadd("visitors", "muhammad", "budi", "joko");
        Redis::pfadd("visitors", "rully", "budi", "joko");

        $result = Redis::pfcount("visitors");
        self::assertEquals(6, $result);

    }

    public function testPipeline()
    {
        Redis::pipeline(function ($pipeline){
            $pipeline->setex("name", 2, "Aldizar");
            $pipeline->setex("address", 2, "Indonesia");
        });

        $response = Redis::get("name");
        self::assertEquals("Aldizar", $response);
        $response = Redis::get("address");
        self::assertEquals("Indonesia", $response);
    }

    public function testTransaction()
    {
        Redis::transaction(function ($transaction){
            $transaction->setex("name", 2, "Aldizar");
            $transaction->setex("address", 2, "Indonesia");
        });

        $response = Redis::get("name");
        self::assertEquals("Aldizar", $response);
        $response = Redis::get("address");
        self::assertEquals("Indonesia", $response);
    }

    public function testPublish()
    {
        for ($i = 0; $i < 10; $i++) {
            Redis::publish("channel-1", "Hello World $i");
            Redis::publish("channel-2", "Good Bye $i");
        }
        self::assertTrue(true);
    }

    public function testPublishStream()
    {
        for ($i = 0; $i < 10; $i++) {
            Redis::xadd("members", "*", [
                "name" => "Aldizar $i",
                "address" => "Indonesia"
            ]);
        }
        self::assertTrue(true);
    }

    public function testCreateConsumer()
    {
        Redis::xgroup("create", "members", "group1", "0");
        Redis::xgroup("createconsumer", "members", "group1", "consumer-1");
        Redis::xgroup("createconsumer", "members", "group1", "consumer-2");
        self::assertTrue(true);

    }

    public function testConsumerStream()
    {
        $result = Redis::xreadgroup("group1", "consumer-1", ["members" => ">"], 3, 3000);

        self::assertNotNull($result);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
}
