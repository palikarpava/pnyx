<?php

require_once "Map.php";

class MapThird extends Map
{
    /**
     * @param string $region
     * @return string|null
     */
    public function getPointClass($region)
    {
        switch ($region) {
            case self::REGION_EUROPE:
                return 'europe';

            case self::REGION_AFRICA:
                return 'africa';

            case self::REGION_ASIA:
                return 'asia';

            case self::REGION_AUSTRALIA:
                return 'australia';

            case self::REGION_AMERICA:
                return 'samerica';

            case self::REGION_NORTH_AMERICA:
                return 'namerica';

            default:
                return null;
        }
    }

    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return 'third_map';
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
                'class' => $this->getPointClass($region_key),
                'value' => $region_name,
            ];
        }

        return [
            'regions' => $result
        ];
    }
}