<?php

class Paddkey
{
    public function adjustKeyLength($key, $length)
    {
        $keyLength = strlen($key);

        if ($keyLength < $length / 8) {
            $key = str_pad($key, $length / 8, "\0");
        } elseif ($keyLength > $length / 8) {
            $key = substr($key, 0, $length / 8);
        }

        return $key;
    }
}

?>