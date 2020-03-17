<?php

namespace Dcat\Admin;

use Dcat\Admin\Support\Helper;

/**
 * Class Color
 *
 * @package Dcat\Admin
 *
 * @method string primary(int $amt = 0)
 * @method string primaryDarker(int $amt = 0)
 * @method string link(int $amt = 0)
 * @method string info(int $amt = 0)
 * @method string success(int $amt = 0)
 * @method string danger(int $amt = 0)
 * @method string warning(int $amt = 0)
 * @method string indigo(int $amt = 0)
 * @method string blue(int $amt = 0)
 * @method string red(int $amt = 0)
 * @method string orange(int $amt = 0)
 * @method string green(int $amt = 0)
 * @method string cyan(int $amt = 0)
 * @method string purple(int $amt = 0)
 * @method string custom(int $amt = 0)
 * @method string pink(int $amt = 0)
 * @method string dark(int $amt = 0)
 * @method string white(int $amt = 0)
 * @method string white50(int $amt = 0)
 * @method string blue1(int $amt = 0)
 * @method string blue2(int $amt = 0)
 * @method string orange1(int $amt = 0)
 * @method string indigoDarker(int $amt = 0)
 * @method string redDarker(int $amt = 0)
 * @method string blueDarker(int $amt = 0)
 * @method string cyanDarker(int $amt = 0)
 * @method string dark20(int $amt = 0)
 * @method string dark30(int $amt = 0)
 * @method string dark40(int $amt = 0)
 * @method string dark50(int $amt = 0)
 * @method string dark60(int $amt = 0)
 * @method string dark70(int $amt = 0)
 * @method string dark80(int $amt = 0)
 * @method string dark90(int $amt = 0)
 * @method string dark90half(int $amt = 0)
 * @method string font(int $amt = 0)
 * @method string grayBg(int $amt = 0)
 * @method string border(int $amt = 0)
 * @method string inputBorder(int $amt = 0)
 */
class Color
{
    /**
     * 颜色
     *
     * @var array
     */
    protected static $colors = [
        'cyan' => [
            'css' => [

            ],
            'colors' => [
                'primary'        => 'cyan',
                'primary-darker' => 'cyan-darker',
                'link'           => 'cyan-darker',
            ],
        ],
        'indigo' => [
            'css' => [

            ],
            'colors' => [
                'primary'        => 'indigo',
                'primary-darker' => 'indigo-darker',
                'link'           => 'indigo-darker',
            ],
        ],
    ];

    /**
     * 默认颜色
     *
     * @var array
     */
    protected static $default = [
        'info'    => 'blue',
        'success' => 'green',
        'danger'  => 'red',
        'warning' => 'orange',
        'indigo'  => '#5c6bc6',
        'blue'    => '#3085d6',
        'red'     => '#ea5455',
        'orange'  => '#ff9f43',
        'green'   => '#21b978',
        'cyan'    => '#7367f0',
        'purple'  => '#5b69bc',
        'custom'  => '#59a9f8',
        'pink'    => '#ff8acc',
        'dark'    => '#22292f',
        'white'   => '#fff',
        'white50' => 'hsla(0,0%,100%,.5)',

         // 其他蓝色
        'blue-1' => '#007ee5',
        'blue-2' => '#4199de',

        // 淡黄色
        'orange-1' => '#ffcc80',

        'indigo-darker' => '#495abf',
        'red-darker'    => '#bd4147',
        'blue-darker'   => '#236bb0',
        'cyan-darker'   => '#6355ee',

        // 深色
        'dark20' => '#f6fbff',
        'dark30' => '#f4f7fa',
        'dark40' => '#ebf0f3',
        'dark50' => '#d3dde5',
        'dark60' => '#bacad6',
        'dark70' => '#b3b9bf',
        'dark80' => '#7c858e',
        'dark85' => '#5c7089',
        'dark90' => '#252d37',

        // 文本通用颜色
        'font' => '#414750',

        // 灰色背景
        'gray-bg' => '#f1f1f1',

        // 边框颜色
        'border' => '#ebeff2',

        // 表单边框
        'input-border' => '#d9d9d9',
    ];

    /**
     * 主题名称.
     *
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $currentColors = [];

    /**
     * Color constructor.
     *
     * @param string $name
     */
    public function __construct($name = null)
    {
        $this->name = ($name ?: config('admin.layout.color')) ?: 'indigo';

        $this->currentColors = array_merge(
            static::$default,
            static::$colors[$this->name]['colors'] ?? []
        );
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * 获取css文件路径.
     *
     * @return array
     */
    public function css()
    {
        return static::$colors[$this->name]['css'];
    }

    /**
     * 获取颜色.
     *
     * @param array  $colorName
     * @param string $default
     *
     * @return string
     */
    public function get(string $colorName, string $default = null)
    {
        $result = $this->currentColors[$colorName] ?? $default;

        if ($result && ! empty($this->currentColors[$result])) {
            return $this->get($result, $default);
        }

        return $result;
    }

    /**
     * 获取所有颜色.
     *
     * @return array
     */
    public function all()
    {
        return $this->currentColors;
    }

    /**
     * 颜色转亮.
     *
     * @param string $color
     * @param int    $amt
     *
     * @return string
     */
    public function lighten(string $color, int $amt)
    {
        return Helper::colorLighten($this->get($color, $color), $amt);
    }

    /**
     * 颜色转暗.
     *
     * @param string $color
     * @param int    $amt
     *
     * @return string
     */
    public function darken(string $color, int $amt)
    {
        return Helper::colorDarken($this->get($color, $color), $amt);
    }

    /**
     * 颜色透明度转化.
     *
     * @param string       $color
     * @param float|string $alpha
     *
     * @return string
     */
    public function alpha(string $color, $alpha)
    {
        return Helper::colorAlpha($this->get($color, $color), $alpha);
    }

    /**
     * 获取颜色.
     *
     * @param string $method
     * @param array $arguments
     *
     * @return string
     */
    public function __call(string $method, array $arguments = [])
    {
        return $this->darken(
            Helper::slug($method),
            $arguments[0] ?? 0
        );
    }

    /**
     * 扩展颜色.
     *
     * @param string       $name
     * @param string|array $skinPath
     * @param array        $colors
     *
     * @return void
     */
    public static function extend(string $name, $skinPath, array $colors)
    {
        static::$colors[$name] = [
            'css'    => array_filter((array) $skinPath),
            'colors' => $colors,
        ];
    }
}
