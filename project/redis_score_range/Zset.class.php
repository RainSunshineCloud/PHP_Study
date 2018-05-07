<?php
/**
 * 有序集合类，但需注意键名未作事务处理，可能会导致错误
 * Created by PhpStorm.
 * User: RyanWu
 * Date: 2018/5/2
 * Time: 16:40
 */

class Zset
{
    protected static $host = 'localhost';
    protected static $port = '6379';
    protected static $redis = null;
    protected static $timeout = 10;
    public  static $key = null;

    /**
     *初始化
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 12:16
     * @param string $host
     * @param string $port
     * @param string $timeout
     * @return mixed
     */
    protected static function initial()
    {
        if (static::$redis !== null) {
            return ;
        }
        static::$redis = new Redis();
        static::$redis->connect(static::$host,static::$port,static::$timeout);
    }

    /**
     *获取值
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 17:30
     * @param array $member
     * @param bool $ger_score
     * @param string $order_by
     * @return mixed
     */
    protected static function get($member = [0,-1],$ger_score = true,$order_by='desc')
    {
        if (is_string($member) && $member != '*') {
            return static::$redis->Zscore(static::$key,$member);
        }

        $func = 'Z';
        if ($order_by == 'desc') {
            $func .= 'Rev';
        }


        $func .= 'Range';

        return static::$redis->$func(static::$key,$member[0],$member[1],$ger_score);

    }

    /**
     *根据分数获取值
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 17:29
     * @param $score_limit
     * @param array $arr
     * @param string $order_by
     * @return mixed
     */
    protected static function getByScore($score_limit,array $arr = [],$order_by = 'asc')
    {
        $arr += [
            'withscores' => true,
            'limit'=>[0,1],
        ];

        $func = 'Z';
        if ($order_by == 'desc') {
            $func .= 'Rev';
            rsort($score_limit);
        }
        $func .= 'RangeByScore';
        return static::$redis->$func(static::$key,$score_limit[0],$score_limit[1],$arr);
    }

    /**
     *根据排名获取值
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 17:29
     * @param $member
     * @param $order_by
     * @return mixed
     */
    protected static function getRank($member,$order_by)
    {

        $func = 'Z';
        if ($order_by == 'desc') {
            $func .= 'Rev';
        }
        $func .= 'Rank';
        return static::$redis->$func(static::$key,$member);
    }

    /**
     *根据成员名删除值
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 17:28
     * @param $member
     * @return mixed
     */
    protected static  function remove($member)
    {
        return static::$redis->ZRem(static::$key,$member);
    }

    /**
     *根据排名删除值
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 17:28
     * @param array $rank
     * @return mixed
     */
    protected  static function remByRank(array $rank)
    {
        return static::$redis->ZRemRangeByRank(static::$key,$rank[0],$rank[1]);
    }

    /**
     *根据分数删除值
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 17:27
     * @param array $score
     * @return mixed
     */
    protected static function remByScore(array $score)
    {
        return static::$redis->zRemByScore(static::$key,$score[0],$score[1]);
    }

    /**
     *更新对应的值
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 17:27
     * @param $member
     * @param $score
     * @return mixed
     */
    protected static function update( $member,$score)
    {
        return static::$redis->zadd(static::$key,$score,$member);
    }

    /**
     *设置项目的键
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 12:30
     * @param string $key
     */
    protected static function setKey($key = 'artical:score')
    {
        if (static::$redis->exists($key) && static::$redis->type($key) != 4 ) {
            throw new TypeException('键名存在，但不是有序集');
        }
        static::$key = $key;

    }


    /**
     *增加评分
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 12:14
     * @param $member
     * @param $score
     * @return bool
     */
    protected static function addScore($member,$score)
    {
       
        if ( $res = static::$redis->zIncrBy(static::$key,$score,$member) === false ) {
            throw new RedisException('添加失败');
        }
        return $res;
    }

    /**
     *静态调用
     * User: RyanWu
     * Date: 2018/5/2
     * Time: 12:30
     * @param $name
     * @param $args
     */
    public static function __callStatic($name,$args)
    {
        try{

            if (!method_exists(get_called_class(),$name)) {
                throw new Error('不存在该类'.$name);
            }

            //初始化动作
            call_user_func_array('static::initial',array());

            //设置键名，并判断键是否可用
            if (self::$key === null && $name !== 'setKey') {
                call_user_func_array('static::setKey',[]);
            }
            return  call_user_func_array('static::'.$name,$args);
        } catch (RedisException $e) {

            return $e->getMessage();

        } catch (TypeException $e) {

            return $e->getMessage();

        } catch (throwable $e) {

            return $e->getMessage();

        }
    }

}

class TypeException extends Exception
{

}