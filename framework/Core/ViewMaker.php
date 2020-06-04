<?php

namespace app\Framework\Core;

class ViewMaker
{

    /**
     * @var string
     */
    protected $viewExtension;

    /**
     * ViewMaker constructor.
     */
    public function __construct()
    {
        $this->viewExtension = '.shiv.php';
    }

    /**
     * Create & return view.
     *
     * @param $viewFile
     * @param bool $data
     * @return false|string|string[]|null
     */
    public function make($viewFile, $data = false)
    {
        $file = getPath('views', $viewFile . $this->viewExtension);

        if (file_exists($file) && is_readable($file)) {

            $rawFile = file_get_contents($file);
            return $this->parseFile($rawFile, $data);
        }
    }

    protected function validate()
    {

    }

    /**
     * Parse the view.
     *
     * @param $file
     * @param $data
     * @return string|string[]|null
     */
    protected function parseFile($file, $data)
    {
        $processedFile = '';

        if ($data) {
            foreach ($data as $datumKey => $datum) {

                if (gettype($datum) === 'string') {
                    $strippedFile = $this->stripVariable($file);
                    $processedFile = str_ireplace('{{$' . $datumKey . '}}', $datum, $strippedFile);
                } else if (gettype($datum) === 'array') {
                    //$processedFile = str_ireplace('{{$' . $datumKey . '}}', $datum, $strippedFile);
                    echo $this->loop($file, $data);
                }
            }
        }

        return $processedFile;
    }

    /**
     * Strip spaces between mustaches to result in {{$Variable}}.
     *
     * @param $file
     * @return string|string[]|null
     */
    protected function stripVariable($file)
    {
        return preg_replace_callback("~\{([^\)]*)\}~", function($s) {
            return str_replace(" ", "", "{{$s[1]}}");
        }, $file);
    }


    protected function loop($file, $data)
    {
        $loops = $this->getBetween($file, '@foreach', '@endforeach');
        $parsed = '';

        foreach ($loops as $loop) {
            $paramStr = $this->getBetween($loop, '(', ')')[0];
            $params = preg_grep('/(\$\w+)/', explode(' ', $paramStr));;
            $variableName = str_ireplace('$', '', $params[0]);

            if (array_key_exists($variableName, $data)) {
                foreach ($data[$variableName] as $datumKey => $datum) {
                    $execution = $this->stripVariable(str_ireplace('(' . $paramStr . ')', '', $loop));
                    $processedText = str_ireplace('{{' . $params[2] . '}}', $datum, $execution);

                    $parsed .= $processedText;
                }
            } else {
                // Throw error! Not found
            }
        }

        return $parsed;
    }

    /**
     * Get String in Between.
     *
     * @param $str
     * @param $startDelimiter
     * @param $endDelimiter
     * @return array
     */
    protected function getBetween($str, $startDelimiter, $endDelimiter) {
        $contents = [];
        $startDelimiterLength = strlen($startDelimiter);
        $endDelimiterLength = strlen($endDelimiter);
        $startFrom = $contentStart = $contentEnd = 0;

        while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
            $contentStart += $startDelimiterLength;
            $contentEnd = strpos($str, $endDelimiter, $contentStart);
            if (false === $contentEnd) {
                break;
            }
            $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
            $startFrom = $contentEnd + $endDelimiterLength;
        }

        return $contents;
    }
}