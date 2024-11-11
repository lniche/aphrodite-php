<?php

namespace App\Utils;

class Snowflake
{
    const EPOCH = 1609459200000;  // 自定义一个起始时间（毫秒级别的时间戳）

    protected $workerId;
    protected $sequence = 0;
    protected $lastTimestamp = -1;

    protected $workerIdBits = 5;
    protected $maxWorkerId = -1 ^ (-1 << 5);  // 最大工人 ID
    protected $sequenceBits = 12;  // 序列号的位数
    protected $workerIdShift = 12;
    protected $timestampShift = 17;
    protected $sequenceMask = -1 ^ (-1 << 12);

    public function __construct($workerId = 1)
    {
        if ($workerId > $this->maxWorkerId || $workerId < 0) {
            throw new \Exception("Worker ID out of range");
        }
        $this->workerId = $workerId;
    }

    public function generateId()
    {
        $timestamp = $this->currentTimestamp();
        if ($timestamp == $this->lastTimestamp) {
            $this->sequence = ($this->sequence + 1) & $this->sequenceMask;
            if ($this->sequence == 0) {
                $timestamp = $this->waitForNextMillis($this->lastTimestamp);
            }
        } else {
            $this->sequence = 0;
        }

        $this->lastTimestamp = $timestamp;

        return (($timestamp - self::EPOCH) << $this->timestampShift)
            | ($this->workerId << $this->workerIdShift)
            | $this->sequence;
    }

    protected function currentTimestamp()
    {
        return (int) (microtime(true) * 1000);
    }

    protected function waitForNextMillis($lastTimestamp)
    {
        $timestamp = $this->currentTimestamp();
        while ($timestamp <= $lastTimestamp) {
            $timestamp = $this->currentTimestamp();
        }
        return $timestamp;
    }
}
