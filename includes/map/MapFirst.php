<?php

require_once "Map.php";

class MapFirst extends Map
{
    /**
     * @param string $region
     * @return null|string
     */
    public function getRegionTransform($region)
    {
        switch ($region) {
            case self::REGION_EUROPE:
                return 'translate(340 85)';

            case self::REGION_AFRICA:
                return 'translate(370 180)';

            case self::REGION_ASIA:
                return 'translate(500 130)';

            case self::REGION_AUSTRALIA:
                return 'translate(560 250)';

            case self::REGION_AMERICA:
                return 'translate(180 230)';

            case self::REGION_NORTH_AMERICA:
                return 'translate(100, 104)';

            default:
                return null;
        }
    }

    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return 'first_map';
    }

    /**
     * @return array
     */
    public function getViewParams()
    {
        $results = $this->getResults();

        $result = [];
        foreach ($results as $region_key => $region_name) {
            $result[$region_key] = [
                'transform' => $this->getRegionTransform($region_key),
                'value' => $region_name,
            ];
        }

        return [
            'regions' => $result
        ];
    }
}