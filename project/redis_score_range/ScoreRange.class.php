<?php
include './Zset.class.php';

class ScoreRange extends Zset
{
    protected function __construct()
    {

    }

    protected static $life_time_constant = 432;

    /**
     *计算score的值并存储
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 17:43
     * @param $member
     * @param $score
     * @return float|int
     */
    protected static function AddScoreMethod($member,$score)
    {
        $score =  time() + $score * self::$life_time_constant;
        return self::addScore($member,$score);
    }

    /**
     *通过投票分数和生存时间来判断至少置顶多久
     *默认：200票以上的置顶至少一天
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 12:00
     * @param int $limit_score
     * @param int|float $life_time
     */
    protected static function setLifetime ( $limit_score = 200, $life_time = 1)
    {
        self::$life_time_constant = ceil($life_time * 3600 * 24/$limit_score);
    }

}





