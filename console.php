<?php

    const BLACK = "\33[0;30m";
    const GRAY = "\33[1;30m";
    const MAROON = "\33[0;31m";
    const RED = "\33[1;31m";
    const GREEN = "\33[0;32m";
    const LIME = "\33[1;32m";
    const YELLOW = "\33[1;33m";
    const BROWN = "\33[0;33m";
    const NAVY = "\33[0;34m";
    const BLUE = "\33[1;34m";
    const PURPLE = "\33[0;35m";
    const PINK = "\33[1;35m";
    const CYAN = "\33[0;36m";
    const AQUA = "\33[1;36m";
    const SILVER = "\33[0;37m";
    const WHITE = "\33[1;37m";

    function color ($text, $color)
    {
    	return $color.$text."\033[0;39m";
    }

    function clean ($string)
    {
        return str_replace (
            ["\033[0;39m",BLACK,GRAY,MAROON,RED,GREEN,LIME,YELLOW,BROWN,NAVY,BLUE,PURPLE,PINK,CYAN,AQUA,SILVER,WHITE],
            '',
            $string);
    }


/*    echo color ('BLACK ', BLACK);
    echo color ('GRAY ', GRAY);
    echo color ('MAROON ', MAROON);
    echo color ('RED ', RED);
    echo color ('GREEN ', GREEN);
    echo color ('LIME ', LIME);
    echo color ('YELLOW ', YELLOW);
    echo color ('BROWN ', BROWN);
    echo color ('NAVY ', NAVY);
    echo color ('BLUE ', BLUE);
    echo color ('PURPLE ', PURPLE);
    echo color ('PINK ', PINK);
    echo color ('CYAN ', CYAN);
    echo color ('AQUA ', AQUA);
    echo color ('SILVER ', SILVER);
    echo color ('WHITE', WHITE);
    echo "\n";*/

    /*
    	should we keep it ?
    */
    function table ($data, $color=GRAY)
    {
        // Find longest string in each column
        $lengths = [];
        foreach ($data as $item)
        {
            foreach ($item as $field => $value)
            {
                $length = strlen(clean($value));
                if (empty($lengths[$field]) || $lengths[$field] < $length)
                {
                    $lengths[$field] = $length;
                }
            }
        }

        // Output table, padding columns

        $width = count($item);
        $height = count($data);

        $table = '';
        $cell = 0;
        foreach ($item as $field => $value)
        {
            $cell++;
            if ($cell==1)
            {
                $table .= color('┌',$color).str_repeat(color('─',$color),$lengths[$field]).color('┬',$color);
            }
            else if ($cell==$width)
            {
                $table .= str_repeat(color('─',$color),$lengths[$field]).color('┐',$color);
            }
            else
            {
                $table .= str_repeat(color('─',$color),$lengths[$field]).color('┬',$color);
            }

        }
        $table .= PHP_EOL;

        $row = 0;
        foreach ($data as $item)
        {
            $row++;
            $cell = 0;
            foreach ($item as $field => $value)
            {
                $cell++;
                if ($cell==1)
                {
                    $space = '';
                    $length = $lengths[$field]-strlen(clean($value));
                    if ($length>0)
                    {
                        $space = str_repeat(' ',$length);
                    }
                    $table .= color('│',$color).$space.$value.color('│',$color);

                }
                else if ($cell==$width)
                {
                    $table .= str_repeat(' ',$lengths[$field]-strlen(clean($value))).$value.color('│',$color);
                }
                else
                {

                    $table .= str_repeat(' ',$lengths[$field]-strlen(clean($value))).$value.color('│',$color);
                }

            }
            $table .= PHP_EOL;
            $cell = 0;
            foreach ($item as $field => $value)
            {
                $cell++;
                if ($row==$height)
                {

                    if ($cell==1)
                    {
                        $table .= color('└',$color).str_repeat(color('─',$color),$lengths[$field]).color('┴',$color);
                    }
                    else if ($cell==$width)
                    {
                        $table .= str_repeat(color('─',$color),$lengths[$field]).color('┘',$color);
                    }
                    else
                    {
                        $table .= str_repeat(color('─',$color),$lengths[$field]).color('┴',$color);
                    }

                }
                else
                {

                    if ($cell==1)
                    {
                        $table .= color('├',$color).str_repeat(color('─',$color),$lengths[$field]).color('┼',$color);
                    }
                    else if ($cell==$width)
                    {
                        $table .= str_repeat(color('─',$color),$lengths[$field]).color('┤',$color);
                    }
                    else
                    {
                        $table .= str_repeat(color('─',$color),$lengths[$field]).color('┼',$color);
                    }
                }
            }
            $table .= PHP_EOL;

        }
        //debug ($lengths);
        return $table;
    }

    function termux_notification ($title, $content, $led)
    {
        if (PHP_OS!='WINNT' && `which termux-notification`)
        {
            try
            {
                shell_exec ('termux-notification --title="'.$title.'" --content="'.$content.'" --led="'.$led.'"');
            }
            catch (\Exception $e)
            {
                
            }
        }
    }

?>