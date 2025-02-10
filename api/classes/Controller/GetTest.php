<?php
namespace Api\Classes\Controller;

use Api\Classes\Model\Test;

/**
 * DRY traits metodei, kuru vairākkārt izmanto dažādas kontrolleru darbības
 */

trait GetTest {
    protected function getTest(?int $testId): ?Test
    {
        if ($testId) {
            // Testus var aizliegt, lai noņemtu no izvēlnes nedzēšot
            
            $ret = Test::where('id', $testId)
                ->where('enabled', true)
                ->first();
        } else {
            $ret = null;
        }

        return $ret;
    }
}