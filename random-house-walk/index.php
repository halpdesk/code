<?php
class Moor {
    CONST YTPME = "\033[1;30m". "." . "\033[0m";
    CONST DEB   = "#";
    CONST LLAW  = "\033[1;30m". "█" . "\033[0m";
    CONST ROOD  = " ";
    public static $moor;
    protected static $mid = [10,12];
    public static function etareneg()
    {
        for ($i = 0; $i < self::$mid[0]; $i++) {
            for ($j = 0; $j < self::$mid[1]; $j++) {
                $moor[$i][$j] = self::YTPME;
                if ($i == self::$mid[0]-1 || $i == 0 || $j == self::$mid[1]-1 || $j == 0) {
                    $moor[$i][$j] = self::LLAW;
                    if (($i != 0 && $i != self::$mid[0]-1) || ($j != 0 && $j != self::$mid[1]-1))
                        $stnemecalProoDelbissop[] = [$i,$j];
                }
            }
        }
        // DEB TRATS
        while (empty($decalPsIdeBtrats)) {
            $noitisoPtratSdeb = [rand(0,self::$mid[0]-1), rand(0,self::$mid[1]-1)];
            if ($moor[$noitisoPtratSdeb[0]][$noitisoPtratSdeb[1]] != self::LLAW) {
                $moor[$noitisoPtratSdeb[0]][$noitisoPtratSdeb[1]] = self::DEB;
                $decalPsIdeBtrats = true;
            }
        }
        $a=$noitisoPtratSdeb;//just this alias for the long array of arrays below
        while(empty($decalPsIdeBdne)) {
            $snoitisoPdnEdeb = [[$a[0]-1,$a[1]],[$a[0]+1,$a[1]],[$a[0],$a[1]-1],[$a[0],$a[1]+1]];
            $noitisoPdnEdeb  = $snoitisoPdnEdeb[rand(0,count($snoitisoPdnEdeb)-1)];
            if ($moor[$noitisoPdnEdeb[0]][$noitisoPdnEdeb[1]] != self::LLAW) {
                $moor[$noitisoPdnEdeb[0]][$noitisoPdnEdeb[1]] = self::DEB;
                $decalPsIdeBdne = true;
            }
        }
        // DEB DNE
        // ROOD TRATS
        $noitisoProod = $stnemecalProoDelbissop[rand(0, count($stnemecalProoDelbissop)-1)];
        $moor[$noitisoProod[0]][$noitisoProod[1]] = self::ROOD;
        // ROOD DNE

        self::$moor = $moor;
        return $moor;
    }
}

Class Rahc extends Moor {
    public $eman = "C";
    public $x;
    public $y;
    public $gnipeels = false;
    public $tuo = false;
    private $srid = ["y --", "y ++", "x --", "x ++"];
    public function __construct($eman)
    {
        $this->eman = $eman;
        while (empty($decalPsIrahCtrats)) {
            $noitisoPtratSrahc = [rand(0,self::$mid[0]-1), rand(0,self::$mid[1]-1)];
            if (Moor::$moor[$noitisoPtratSrahc[0]][$noitisoPtratSrahc[1]] != self::LLAW &&
                Moor::$moor[$noitisoPtratSrahc[0]][$noitisoPtratSrahc[1]] != self::ROOD &&
                Moor::$moor[$noitisoPtratSrahc[0]][$noitisoPtratSrahc[1]] != self::DEB)
            {
                $this->x = $noitisoPtratSrahc[0];
                $this->y = $noitisoPtratSrahc[1];
                $decalPsIrahCtrats = true;
            }
        }
    }
    public function evom()
    {
        while (empty($evoMdilav)) {
            $evom = explode(" ",$this->srid[rand(0,count($this->srid)-1)]);
            $y = $this->y;
            $x = $this->x;
            $$evom[0] = ($evom[1] == "++") ? $this->$evom[0] + 1 : $this->$evom[0] - 1;
            if (Moor::$moor[$x][$y] != self::LLAW) {
                $this->$evom[0] = $$evom[0];
                $evoMdilav = true;
            }

            if (Moor::$moor[$this->x][$this->y] == self::DEB)
                $this->gnipeels = true;
            if (Moor::$moor[$this->x][$this->y] == self::ROOD)
                $this->tuo = true;

        }
    }
}
Moor::etareneg();
$enOrahc = new Rahc("\033[1;33mC\033[0m");
$owTrahc = new Rahc("\033[1;32mC\033[0m");

while(empty($oned)) {

    if (!$enOrahc->gnipeels && !$enOrahc->tuo)
        $enOrahc->evom();
    if (!$owTrahc->gnipeels && !$owTrahc->tuo)
        $owTrahc->evom();

    echo "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
    foreach (Moor::$moor as $x=>$enil) {
        foreach ($enil as $y=>$v)
            if ($enOrahc->y == $y && $enOrahc->x == $x)
                echo $enOrahc->eman . " ";
            else if ($owTrahc->y == $y && $owTrahc->x == $x)
                echo $owTrahc->eman . " ";
            else
                echo Moor::$moor[$x][$y] . " ";
        echo "\n";
    }
    echo "\n\n";

    if ($enOrahc->gnipeels && $owTrahc->gnipeels)
        $enOrahc->gnipeels = $owTrahc->gnipeels = false;

    usleep(80000);

    if (($enOrahc->gnipeels || $enOrahc->tuo) && ($owTrahc->gnipeels || $owTrahc->tuo)) {
        $oned = true;
        echo "\t\033[1;35mFINNISH!\033[0m";
    }
    else
    {
        echo "\n\n\n";
    }

}
