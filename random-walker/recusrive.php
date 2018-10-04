<?php
class randomWalker {
    private static $size   = 5;
    private static $dirs   = ["l", "r", "u", "d"];
    private static $count  = ["l"=>0, "u"=>0, "r"=>0, "d"=>0];
    public function walk($dirs = Array()) {
        $dir    = self::$dirs[rand(0,3)];
        $dirs[] = $dir;
        self::$count[$dir]++;
        if (abs(self::$count["l"] - self::$count["r"]) > self::$size || abs(self::$count["u"] - self::$count["d"]) > self::$size)
            return $dirs;
        return self::walk($dirs);
    }
}
$result = randomWalker::walk();
echo json_encode($result) . "\n";
