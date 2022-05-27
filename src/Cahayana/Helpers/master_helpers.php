<?php
/**
 * @package     Helpers - Master Helpers
 * @author      singkek
 * @copyright   Copyright(c) 2019
 * @version     1
 **/

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;

if ( ! function_exists('is_json')) {

    /**
     * function to check string is json or not
     *
     * @param $string
     * @return bool
     */
    function is_json($string)
    {
        return is_string($string) &&
            (is_object(json_decode($string)) ||
                is_array(json_decode($string)));
    }
}

if ( ! function_exists('get_browser_data'))
{
    function get_browser_data()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $platform = 'Unknown';

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/OPR/i',$u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }
        else
        {
            $bname = 'Other';
            $ub = "Other";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern,
            'alias'     => strtolower(str_replace(' ', '-', $ub).'-'.$version.'-'.$platform)
        );
    }
}

if ( ! function_exists('convert_date')) {

    /**
     * convert date from some format to different format
     *
     * @param $from
     * @param $to
     * @param $date
     * @return string
     */
    function convert_date($from, $to, $date)
    {
        return Carbon::createFromFormat($from,$date)->translatedFormat($to);
    }
}

if ( ! function_exists('format_date'))
{
    /**
     * date format
     *
     * @param string $date
     * @param string $format
     * @param string $timezone
     * @param string $locale
     * @return string
     */
    function format_date(string $date = '', string $format = 'default', string $timezone = '', string $locale = '')
    {
        $date = $date == '' || $date == 'now' ? date('Y-m-d H:i:s') : $date;

        switch ($format)
        {
            case 'short':
                $format = 'd M Y';
                break;
            case 'full_date':
                $format = 'l, d F Y';
                break;
            case 'full_date_time':
                $format = 'l, d F Y - H:i:s';
                break;
            case 'date_time':
                $format = 'd F Y - H:i:s';
                break
            default:
                $format = 'Y-m-d H:i:s';
                break;
        }

        if($locale !== '')
        {
            Carbon::setLocale($locale);
        }

        $timezone = $timezone !== '' ? $timezone : config('app.timezone');

        return Carbon::parse(date('Y-m-d H:i:s',strtotime($date)))->timezone($timezone)->translatedFormat($format);
    }
}

if ( ! function_exists('range_date'))
{
    /**
     * date range list
     *
     * @param $date_start
     * @param $date_end
     * @param string $format
     * @return CarbonInterface[]
     */
    function range_date($date_start, $date_end, string $format = 'Y-m-d')
    {
        $date_start = format_date($date_start,'Y-m-d H:i:s');
        $date_end = format_date($date_end,'Y-m-d H:i:s');

        $period = CarbonPeriod::create($date_start, $date_end);

        foreach ($period as $date) {
            echo $date->translatedFormat($format);
        }

        return $period->toArray();
    }
}

if ( ! function_exists('diff_date'))
{

    function diff_date($date_start, $date_end, $format = 'year')
    {
        $date_start = format_date($date_start,'Y-m-d H:i:s');
        $date_end = format_date($date_end,'Y-m-d H:i:s');

        $date_start = Carbon::parse($date_start);
        $date_end   = Carbon::parse($date_end);

        switch ($format)
        {
            case 'month' :
                return $date_start->diffInMonths($date_end);
                break;
            case 'day' :
                return $date_start->diffInDays($date_end);
                break;
            case 'week' :
                return $date_start->diffInWeeks($date_end);
                break;
            case 'hour' :
                return $date_start->diffInHours($date_end);
                break;
            case 'minute' :
                return $date_start->diffInMinutes($date_end);
                break;
            case 'second' :
                return $date_start->diffInSeconds($date_end);
                break;
            default :
                return $date_start->diffInYears($date_end);
                break;
        }
    }
}

if ( ! function_exists('facebook_timespan'))
{
    /**
     * facebook time format
     *
     * generate format time like on facebook
     *
     * @param $date
     * @param string $timezone
     * @param string $locale
     * @return string
     */
    function facebook_timespan($date, string $timezone = '', string $locale = '')
    {
        if($locale !== '')
        {
            Carbon::setLocale($locale);
        }

        $timezone = $timezone !== '' ? $timezone : config('app.timezone');

        return Carbon::createFromTimeStamp(strtotime($date))->timezone($timezone)->diffForHumans();
    }
}
