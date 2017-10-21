<?php
/**
 * Created by PhpStorm.
 * User: Galip Özen galip.ozen@hotmail.com
 * Date: 16.10.2017
 * Time: 21:04
 */

namespace Env;


class Env
{
    private $envFileName = '.env';

    private $splFileObject;

    public function __construct(String $envFileName = null)
    {
        if ($envFileName !== null) {
            $this->envFileName = $envFileName;
        }
        if (file_exists($this->envFileName) !== true) {
            throw new \Exception('The environment file not found.');
        }
        $this->splFileObject = new \SplFileObject($this->envFileName);
    }


    public function getEnv(String $key): String
    {
        while (!$this->splFileObject->eof()) {
            $line = $this->splFileObject->fgets();
            $explodedLine = explode('=', $line, 2);
            if (count($explodedLine) !== 2) {
                throw new \Exception('Invalid define in env file. Parameter should be that "KEY=value"' . $line);
            }
            if ($key === $explodedLine[0]) {
                $value = $explodedLine[1];
                break;
            }
        }

        return $value;
    }
}